<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionsController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->get('search');

        $regions = Region::with('users')
        ->when($search, function($query, $search) {
            return $query->where('nom', 'like', "%{$search}%");
        })
        ->paginate(4); // Pagination Laravel native !

        return view('backend.admin.regions', compact('regions', 'search'));
    }

    // Méthode pour ajouter un nouveau rôle
    public function addregion(Request $request)
    {
        
        $request->validate([
            'nom' => 'required|string|max:255|unique:regions,nom',
            'description' => 'nullable|string|max:500',
            'localisation' => 'nullable|string|max:255',
            'superficie' => 'required|string|max:255',
            'population' => 'required|integer',
        ]);

        $region = new Region();
        $region->nom = $request->nom;
        $region->description = $request->description;
        $region->localisation = $request->localisation;
        $region->superficie = $request->superficie;
        $region->population = $request->population;
        $region->save();

        return redirect()->route('regions')->with('success', 'Région ajoutée avec succès!');
    }

    public function supprimer(Request $request){
        $rules = [
            'id' => 'required',
        ];

        $request->validate($rules);

        $region = Region::findOrFail($request->id);
        $region->delete();

        return redirect()->route('regions')
            ->with('success', 'Région supprimée.');
    }
}
