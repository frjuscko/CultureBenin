<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Langue;

use function Laravel\Prompts\search;
use function Pest\Laravel\delete;

class LanguesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $langues = Langue::with('users')
        ->when($search, function($query, $search) {
            return $query->where('code', 'like', "%{$search}%")
                        ->orWhere('nom', 'like', "%{$search}%");
        })
        ->paginate(4); // Pagination Laravel native !

        return view('backend.admin.langues', compact('langues', 'search'));
    }

    // Méthode pour ajouter un nouveau rôle
    public function addlangue(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:langues,code',
            'nom' => 'required|string|max:255|unique:langues,nom',
            'description' => 'nullable|string|max:500'
        ]);

        $langue = new Langue();
        $langue->code = $request->code;
        $langue->nom = $request->nom;
        $langue->description = $request->description;
        $langue->save();

        return redirect()->route('langues')->with('success', 'Langue ajoutée avec succès!');
    }

    public function supprimer(Request $request){
        $rules = [
            'id' => 'required',
        ];

        $request->validate($rules);

        $langue = Langue::findOrFail($request->id);
        $langue->delete();

        return redirect()->route('langues')
            ->with('success', 'Langue supprimée.');
    }
}
