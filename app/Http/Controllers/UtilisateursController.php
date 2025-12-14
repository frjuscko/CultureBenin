<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class UtilisateursController extends Controller 
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $users = User::with('getRole', 'getRegion', 'getLangue')
        ->when($search, function($query, $search) {
            return $query->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenom', 'like', "%{$search}%")
                        ->orWhere('role', 'like', "%{$search}%")
                        ->orWhere('langue', 'like', "%{$search}%")
                        ->orWhere('region', 'like', "%{$search}%");
        })
        ->paginate(4);

        // Récupérer les rôles avec le nombre d'utilisateurs pour chaque rôle
        $roles = Role::withCount('users')->get();

        return view('backend.admin.utilisateurs', compact('users', 'roles', 'search'));
    }

    // Méthode pour ajouter un nouveau rôle
    public function storeRole(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:255|unique:roles,libelle'
        ]);

        $role = new Role();
        $role->libelle = $request->libelle;
        $role->save();

        return redirect()->route('utilisateurs')->with('success', 'Rôle ajouté avec succès!');
    }

}
