<?php

namespace App\Http\Controllers;

use App\Models\Langue;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfilController extends Controller
{
    /**
     * Affiche le profil d'un utilisateur
     */
    public function index($id)
    {
        $user = User::with([
            'getRole',
            'getLangue',
            'getRegion',
            'contenus' => function ($query) {
                $query->valides()->latest()->take(6);
            },
            'commentaires.getContenu',
        ])->findOrFail($id);

        // Statistiques
        $stats = [
            'contenus' => $user->contenus->count(),
            'commentaires' => $user->commentaires->count(),
            'contenus_valides' => $user->contenus()->valides()->count(),
            'contenus_en_attente' => $user->contenus()->enAttente()->count(),
        ];

        return view('profil.show', compact('user', 'stats'));
    }

    /**
     * Affiche le formulaire d'édition du profil
     */
    public function edit()
    {
        $user = Auth::user();
        $langues = Langue::all();
        $regions = Region::all();

        return view('profil.edit', compact('user', 'langues', 'regions'));
    }

    /**
     * Met à jour le profil
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'sexe' => 'required|in:Masculin,Féminin',
            'langue' => 'nullable|exists:langues,id',
            'region' => 'nullable|exists:regions,id',
            'bio' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ];

        $request->validate($rules);

        // Mise à jour des informations de base
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->sexe = $request->sexe;
        $user->langue = $request->langue;
        $user->region = $request->region;

        // Gestion de la photo
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:png,jpg,jpeg|max:2048',
            ]);
            // Supprime l'ancienne photo si ce n'est pas une photo par défaut
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            // Stockage dans storage/app/public/contenus
            $file = $request->file('photo');
            $filename = uniqid().'.'.$file->getClientOriginalExtension();
            $chemin = $file->storeAs('avatars',$filename, 'public');

            $user->photo = 'avatars/'.$filename;
        }

        // Gestion du mot de passe
        if ($request->filled('current_password')) {
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
            } else {
                return back()->withErrors([
                    'current_password' => 'Le mot de passe actuel est incorrect.',
                ]);
            }
        }

        $user->save();

        return redirect()->route('profil', $user->id)
            ->with('success', 'Profil mis à jour avec succès !');
    }

    /**
     * Supprime la photo de profil
     */
    public function deletePhoto()
    {
        $user = Auth::user();

        if ($user->photo && ! Str::startsWith($user->photo, 'avatars/avatar_')) {
            Storage::delete('public/'.$user->photo);
        }

        // Régénère une photo par défaut
        $photoPath = $user->saveDefaultPhoto();
        $user->photo = $photoPath;
        $user->save();

        return back()->with('success', 'Photo de profil supprimée. Avatar par défaut restauré.');
    }

}
