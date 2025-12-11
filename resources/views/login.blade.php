<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ URL::asset('frontend/css/login.css') }}">
        <script src="{{ URL::asset('frontend/js/login.js') }}" defer></script>
        <title>Document</title>
    </head>
    <body>
        <main>
            <div class="textes">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ URL::asset('Logo/Logo CB.PNG') }}" alt="">
                    </a>
                </div>
                <a href="{{ route('home') }}">Culture Bénin</a>
            </div>
            <div class="bg">
                <img src="img/medium-shot-smiley-people-celebrating.jpg" alt
                    srcset>
            </div>
            <div class="container">
                <div class="slides">
                    <div class="slide">
                        <div class="title">
                            <a href="#" class="index">Se connecter</a>
                            <a href="#" class="reg-btn">S'inscrire</a>
                        </div>

                        {{-- Messages d'erreur --}}
                        @if($errors->any())
                            <div class="alert alert-error">
                                @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="input-zone">
                                <div class="input-box">
                                    <input type="email" name="email" value="{{ old('email') }}" required>
                                    <label for>Email</label>
                                </div>
                                <div class="input-box">
                                    <input type="password" name="password" required>
                                    <label for>Mot de passe</label>
                                </div>
                                <div class="choix">
                                    <input type="checkbox">
                                    <label for>Se souvenir de moi</label>
                                </div>
                                <div class="actions">
                                    <a href>Mot de passe oublié ?</a>
                                    <button type="submit" class="submit" name="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M10 11V8L15 12L10 16V13H1V11H10ZM2.4578 15H4.58152C5.76829 17.9318 8.64262 20 12 20C16.4183 20 20 
                                        16.4183 20 12C20 7.58172 16.4183 4 12 4C8.64262 4 5.76829 6.06817 4.58152 9H2.4578C3.73207 4.94289 7.52236 2 12 2C17.5228
                                        2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C7.52236 22 3.73207 19.0571 2.4578 15Z"></path></svg>Se
                                        connecter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="slide">
                        <div class="title">
                            <a href="#" class="log-btn">Se connecter</a>
                            <a href="#" class="index">S'inscrire</a>
                        </div>
                        {{-- Messages d'erreur pour l'inscription --}}
                        @if($errors->any() && (session('active_tab') === 'register' || old('nom')))
                            <div class="alert alert-error">
                                @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        @if(session('error') && session('active_tab') === 'register')
                            <div class="alert alert-error">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('register.submit') }}">
                            @csrf
                            <div class="input-zone">
                                <div class="input-box">
                                    <input type="text" name="nom" required>
                                    <label for>Nom</label>
                                </div>
                                <div class="input-box">
                                    <input type="text" name="prenom" required>
                                    <label for>Prénom</label>
                                </div>
                                <div class="input-box">
                                    <input type="text" name="email" required>
                                    <label for>Email</label>
                                </div>
                                <div class="choix">
                                    <input type="radio" name="sexe" value="Masculin" {{ old('sexe') == 'Masculin' ? 'checked' : '' }}><label
                                        for>Masculin</label>
                                    <input type="radio" name="sexe" value="Féminin" {{ old('sexe') == 'Féminin' ? 'checked' : '' }}><label
                                        for>Féminin</label>
                                </div>
                                <div class="choice">
                                    <select name="langue" id>
                                        <option value>Langue</option>
                                        @foreach ($langues as $langue)
                                            <option value="{{ $langue->id }}" {{ old('id') == $langue->id ? 'selected' : '' }}>{{ $langue->nom }}</option>
                                        @endforeach
                                    </select>
                                    <select name="region" id>
                                        <option value>Région</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}" {{ old('id') == $region->id ? 'selected' : '' }}>{{ $region->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-box">
                                    <input type="password" name="password" required id="pass">
                                    <label for>Mot de passe</label>
                                    <div class="indications">
                                        <p>Le mot de passe doit contenir au moins
                                            :</p>
                                        <p id="maj">1 lettre majuscule</p>
                                        <p id="chiffre">1 chiffre</p>
                                        <p id="special">1 caractère spécial</p>
                                        <p id="nombre">8 caractères</p>
                                        <hr id="barre">
                                    </div>
                                </div>
                                <div class="input-box">
                                    <input type="password" name="password_confirmation" id="password" required>
                                    <label for>Confirmez votre mot de passe</label>
                                </div>
                                <div class="actions">
                                    <button type="submit"
                                        class="submit" id="reg">S'inscrire</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>