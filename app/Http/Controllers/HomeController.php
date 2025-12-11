<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Langue;
use App\Models\Region;
use App\Models\User;
use App\Models\TypeContenu;

class HomeController extends Controller
{
    public function index()
    {

        // Récupère les contenus validés
        $contenus = Contenu::with(['getRegion', 'getLangue', 'getType', 'medias'])
            ->where('statut', 'validé')
            ->orderBy('created_at', 'desc')
            ->take(6) // 6 derniers contenus
            ->get();

        $regions = Region::all();
        $langues = Langue::all();
        $types = TypeContenu::all();
        $contributeurs = User::all()
            ->where('roleinfo.libelle', 'Contributeur');

        return view('home', compact('contenus', 'regions', 'langues', 'types', 'contributeurs'));
    }
}
