<?php

namespace App\Http\Controllers;

use App\Models\Langue;
use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{
    public function index()
    {
        $langues = Langue::all();
        $regions = Region::all();

        return view('login', compact('langues', 'regions'));
    }

    public function login(Request $request)
    {
        // Valider les données
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tenter la connexion
        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            // Récupérer l'utilisateur avec sa relation role
            $user = Auth::user()->load('getRole');

            // Vérifier le rôle et rediriger
            if ($user->isAdmin()) {
                return redirect()->intended('/admin');
            } elseif ($user->isContributeur()) {
                return redirect()->intended('/bord');
            } elseif ($user->isModerator()) {
                return redirect()->intended('/bord');
            } else {
                return redirect()->intended('/');
            }
        }

        // Si échec de connexion
        return back()->withErrors([
            'email' => 'Les identifiants ne correspondent pas.',
        ]);
    }

    // Nouvelle méthode pour l'inscription
    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'sexe' => 'required|in:Masculin,Féminin',
            'langue' => 'required|exists:langues,id',
            'region' => 'required|exists:regions,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $roleLecteur = Role::where('libelle', 'lecteur')->first();

        $initials = strtoupper(substr($request->prenom, 0, 1).substr($request->nom, 0, 1));

        $colors = [
            '#39C252', 
            '#4A90E2', 
            '#F5A623', 
            '#7B61FF', 
            '#FF4757', 
            '#95020eff', 
            '#bfff47ff', 
            '#0e022fff',   
            '#240709ff', 
            '#51008aff', 
            '#0066ffff', 
            '#ffee00ff',
        ];
        $background = $colors[array_rand($colors)];

        $svg = '
<svg width="300" height="300" xmlns="http://www.w3.org/2000/svg">
  <rect width="100%" height="100%" fill="'.$background.'"/>
  <text x="50%" y="50%" font-size="120" fill="white" text-anchor="middle" dominant-baseline="central" font-family="Arial, sans-serif">'.$initials.'</text>
</svg>
';

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'sexe' => $request->sexe,
            'langue' => $request->langue,
            'region' => $request->region,
            'password' => Hash::make($request->password),
            'role' => $roleLecteur->id,
            'statut' => 'actif',
            // Initialiser les champs 2FA
            'google2fa_secret' => null,
            'google2fa_enabled' => false,
        ]);

        // Chemin du fichier
        $filename = 'avatars/'.uniqid().'.svg';
        Storage::disk('public')->put($filename, $svg);

        // Enregistrer dans la DB
        $user->photo = $filename;
        $user->save();

        Auth::login($user);

        return redirect('/dashboard')->with('success', 'Inscription réussie ! Bienvenue !');
    }

    public function logout(Request $request)
    {
        // Supprimer le flag 2FA de la session lors de la déconnexion
        $request->session()->forget('2fa_verified');
        $request->session()->forget('2fa_user_id');
        $request->session()->forget('2fa_remember');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // google2fa_secret et google2fa_enabled sont automatiquement gérés par le modèle
        ]);

        // Générer et afficher le QR Code immédiatement après inscription
        $this->sendTwoFactorSetup($user);

        return $user;

    }

    protected function sendTwoFactorSetup($user)
    {
        // Stocker l'ID de l'utilisateur en session pour l'étape de setup
        session([
            '2fa_user_id' => $user->id,
            '2fa_setup_required' => true,
            '2fa_secret' => $user->google2fa_secret,
        ]);
    }
}
