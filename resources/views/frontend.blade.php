<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/style.css') }}">
    <script src="{{ URL::asset('frontend/js/navbar.js') }}" defer></script>
    <title>Document</title>
</head>

<body>
    <header class="navbar">
        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="{{ URL::asset('Logo/Logo CB.PNG') }}" alt="">
            </a>
        </div>
        <nav class="web">
            <a href="/about">Á propos</a>
            <a href="/blog">Blog</a>
            <a href>Galerie</a>
            @auth
                {{-- Utilisateur connecté --}}
                <a href="{{ route('profil', Auth::user()->id) }}" class="user">
                    {{-- Utilise l'avatar de l'utilisateur connecté --}}
                    <img src="{{ asset('storage/'.Auth::user()->photo) }}" alt="{{ Auth::user()->prenom }}"
                        style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                    <div class="texte">
                        <p>{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</p>
                        <p id="role">{{ Auth::user()->getRole->libelle }}</p>
                    </div>
                </a>
                <a href="/logout"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path
                  d="M5 11H13V13H5V16L0 12L5 8V11ZM3.99927 18H6.70835C8.11862 19.2447 9.97111 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C9.97111 4 8.11862 4.75527 6.70835 6H3.99927C5.82368 3.57111 8.72836 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C8.72836 22 5.82368 20.4289 3.99927 18Z">
                </path>
              </svg></a>
            @else
                {{-- Utilisateur non connecté --}}
                <a href="{{ route('login') }}">Connexion
                </a>
            @endauth
        </nav>
        <nav class="mobile">
            <button class="mobile-btn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M4 3.5L9 8.49955L4 13.5V3.5ZM21 19.9995V17.9995H3V19.9995H21ZM21 12.9995V10.9995H12V12.9995H21ZM21 5.99951V3.99951H12V5.99951H21Z">
                    </path>
                </svg></button>
            <div class="mobile-menu">
                <ul>
                    <li><a href="/about">Á propos</a></li>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href>Galerie</a></li>
                    <li>@auth
                        {{-- Utilisateur connecté --}}
                <a href="{{ route('profil', Auth::user()->id) }}" class="user">
                    {{-- Utilise l'avatar de l'utilisateur connecté --}}
                    <img src="{{ asset('storage/'.Auth::user()->photo) }}" alt="{{ Auth::user()->prenom }}"
                        style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                    <div class="texte">
                        <p>{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</p>
                        <p id="role">{{ Auth::user()->getRole->libelle }}</p>
                    </div>
                </a>
                <a href="/logout"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path
                  d="M5 11H13V13H5V16L0 12L5 8V11ZM3.99927 18H6.70835C8.11862 19.2447 9.97111 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C9.97111 4 8.11862 4.75527 6.70835 6H3.99927C5.82368 3.57111 8.72836 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C8.72836 22 5.82368 20.4289 3.99927 18Z">
                </path>
              </svg></a>
                    @else
                            {{-- Utilisateur non connecté --}}
                            <a href="{{ route('login') }}">Connexion
                            </a>
                        @endauth
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <p>&copy; Culture Bénin 2025. Tous droits réservés.</p>
    </footer>
</body>

</html>