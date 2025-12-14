<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Langue;
use App\Models\Media;
use App\Models\Region;
use App\Models\TypeContenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContenusController extends Controller
{
    /**
     * Affiche le formulaire de publication
     */
    public function create()
    {
        $regions = Region::all();
        $langues = Langue::all();
        $types = TypeContenu::all();

        return view('backend.users.contenus.pub', compact('regions', 'langues', 'types'));
    }

    /**
     * Enregistre un nouveau contenu
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required|string',
            'region' => 'required|exists:regions,id',
            'langue' => 'required|exists:langues,id',
            'type' => 'required|exists:typecontenus,id',
            'fichiers.*' => 'file|mimes:jpg,jpeg,png,gif,mp4,avi,mov,wmv|max:10240', // 10MB max
            'parent' => 'nullable|exists:contenus,id',
        ]);

        // Création du contenu
        $contenu = Contenu::create([
            'titre' => $request->titre,
            'texte' => $request->texte,
            'datepub' => now(),
            'statut' => 'en attente', // Statut par défaut
            'region' => $request->region,
            'langue' => $request->langue,
            'type' => $request->type,
            'auteur' => Auth::id(),
            'parent' => $request->parent, // Pour les traductions
        ]);

        // Gestion des fichiers
        if ($request->hasFile('fichiers')) {
            foreach ($request->file('fichiers') as $fichier) {
                $this->storeMedia($fichier, $contenu->id);
            }
        }

        return redirect()->route('mescontenus')
            ->with('success', 'Contenu publié avec succès ! Il sera visible après validation par un modérateur.');
    }

    /**
     * Stocke un fichier média
     */
    private function storeMedia($fichier, $contenuId)
    {
        // Génération d'un nom unique
        $nomFichier = time().'_'.uniqid().'.'.$fichier->getClientOriginalExtension();

        // Stockage dans storage/app/public/contenus
        $chemin = $fichier->storeAs('contenus', $nomFichier, 'public');

        // Détermination du type
        $type = $fichier->getClientOriginalExtension();
        $categorie = in_array($type, ['jpg', 'jpeg', 'png', 'gif', 'webp']) ? 'image' : 'video';

        // Création de l'entrée média
        Media::create([
            'type' => $type,
            'description' => 'Fichier '.$categorie.' pour le contenu',
            'fichier' => $nomFichier,
            'datepub' => now(),
            'contenu' => $contenuId,
        ]);
    }

    /**
     * Affiche les publications de l'utilisateur
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $types = TypeContenu::all();
        $regions = Region::all();
        $langues = Langue::all();
        $contenus = Contenu::with(['getRegion', 'getLangue', 'getType', 'medias'])
            ->when($search, function ($query, $search) {
                return $query->where('titre', 'like', "%{$search}%");
            })
            ->where('auteur', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('backend.users.contenus.show', compact('contenus', 'regions', 'langues', 'types', 'search'));
    }

    

    /**
     * Formulaire de traduction
     */
    public function traduire($id)
    {
        $contenuOriginal = Contenu::findOrFail($id);
        $langues = Langue::where('id', '!=', $contenuOriginal->langue_id)->get();
        $regions = Region::all();
        $types = TypeContenu::all();

        return view('contenu', compact('contenuOriginal', 'langues', 'regions', 'types'));
    }

    public function nonVal(){
        $NVcontenus = Contenu::with(['getRegion', 'getLangue', 'getType', 'medias'])
            ->where('statut', 'en attente')
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        
        return view('backend.users.contenus.show', compact('NVcontenus'));
    }

    public function valider(Request $request){

        $rules = [
            'id' => 'required',
        ];

        $request->validate($rules);

        $contenu = Contenu::findOrFail($request->id);
        $contenu->statut = 'validé';
        $contenu->save();
        
        return redirect()->route('lescontenus')
            ->with('success', 'Contenu validé avec succès ! Il sera maintenant visible pour tous les utilisateurs.');
    }
}
