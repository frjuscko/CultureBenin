<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/profil.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/contenu.css') }}">
    <script src="{{ URL::asset('frontend/js/profil.js') }}" defer></script>
    <title>Profil de {{ $user->prenom }} {{ $user->nom }} - Culture Bénin</title>
    <style>

    </style>
</head>

<body>
    {{-- Messages de succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Messages d'erreur --}}
    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <div class="cover"></div>
    <div class="profil-header">
        <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->prenom }}" class="profil-avatar">
        <div class="profil-info">
            <h1>{{ $user->prenom }} {{ $user->nom }}</h1>
            <p class="profil-role">{{ $user->getRole->libelle ?? 'Utilisateur' }}</p>

            <div class="profil-meta">
                @if($user->email)
                    <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M3 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3ZM12.0606 11.6829L5.64722 6.2377L4.35278 7.7623L12.0731 14.3171L19.6544 7.75616L18.3456 6.24384L12.0606 11.6829Z">
                            </path>
                        </svg>{{ $user->email }}</span>
                @endif
                @if($user->regioninfo)
                    <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2ZM16.0043 12.8777C15.6589 12.3533 15.4097 11.9746 14.4622 12.1248C12.6717 12.409 12.4732 12.7224 12.3877 13.2375L12.3636 13.3943L12.3393 13.5597C12.2416 14.2428 12.2453 14.5012 12.5589 14.8308C13.8241 16.1582 14.582 17.115 14.8116 17.6746C14.9237 17.9484 15.2119 18.7751 15.0136 19.5927C16.2372 19.1066 17.3156 18.3332 18.1653 17.3559C18.2755 16.9821 18.3551 16.5166 18.3551 15.9518V15.8472C18.3551 14.9247 18.3551 14.504 17.7031 14.1314C17.428 13.9751 17.2227 13.881 17.0582 13.8064C16.691 13.6394 16.4479 13.5297 16.1198 13.0499C16.0807 12.9928 16.0425 12.9358 16.0043 12.8777ZM12 3.83333C9.68259 3.83333 7.59062 4.79858 6.1042 6.34896C6.28116 6.47186 6.43537 6.64453 6.54129 6.88256C6.74529 7.34029 6.74529 7.8112 6.74529 8.22764C6.74488 8.55621 6.74442 8.8672 6.84992 9.09302C6.99443 9.40134 7.6164 9.53227 8.16548 9.64736C8.36166 9.68867 8.56395 9.73083 8.74797 9.78176C9.25405 9.92233 9.64554 10.3765 9.95938 10.7412C10.0896 10.8931 10.2819 11.1163 10.3783 11.1717C10.4286 11.1356 10.59 10.9608 10.6699 10.6735C10.7307 10.4547 10.7134 10.2597 10.6239 10.1543C10.0648 9.49445 10.0952 8.2232 10.268 7.75495C10.5402 7.01606 11.3905 7.07058 12.012 7.11097C12.2438 7.12589 12.4626 7.14023 12.6257 7.11976C13.2482 7.04166 13.4396 6.09538 13.575 5.91C13.8671 5.50981 14.7607 4.9071 15.3158 4.53454C14.3025 4.08382 13.1805 3.83333 12 3.83333Z">
                            </path>
                        </svg>{{ $user->regioninfo->nom }}</span>
                @endif
                @if($user->langueinfo)
                    <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M18.5 10L22.9 21H20.745L19.544 18H15.454L14.255 21H12.101L16.5 10H18.5ZM10 2V4H16V6L14.0322 6.0006C13.2425 8.36616 11.9988 10.5057 10.4115 12.301C11.1344 12.9457 11.917 13.5176 12.7475 14.0079L11.9969 15.8855C10.9237 15.2781 9.91944 14.5524 8.99961 13.7249C7.21403 15.332 5.10914 16.5553 2.79891 17.2734L2.26257 15.3442C4.2385 14.7203 6.04543 13.6737 7.59042 12.3021C6.46277 11.0281 5.50873 9.57985 4.76742 8.00028L7.00684 8.00037C7.57018 9.03885 8.23979 10.0033 8.99967 10.877C10.2283 9.46508 11.2205 7.81616 11.9095 6.00101L2 6V4H8V2H10ZM17.5 12.8852L16.253 16H18.745L17.5 12.8852Z">
                            </path>
                        </svg>{{ $user->langueinfo->nom }}</span>
                @endif
                <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M7 1V3H3C2.44772 3 2 3.44772 2 4V20C2 20.5523 2.44772 21 3 21H10.7546C9.65672 19.6304 9 17.8919 9 16C9 11.5817 12.5817 8 17 8C18.8919 8 20.6304 8.65672 22 9.75463V4C22 3.44772 21.5523 3 21 3H17V1H15V3H9V1H7ZM23 16C23 19.3137 20.3137 22 17 22C13.6863 22 11 19.3137 11 16C11 12.6863 13.6863 10 17 10C20.3137 10 23 12.6863 23 16ZM16 12V16.4142L18.2929 18.7071L19.7071 17.2929L18 15.5858V12H16Z">
                        </path>
                    </svg>{{ $user->created_at->format('M Y') }}</span>
            </div>

            <div class="actions">
                @if(Auth::check() && Auth::id() == $user->id)
                    <a href="{{ route('profiledit') }}" class="btn-profil">✏️ Modifier mon profil</a>
                    @switch(Auth::user())
                        @case(Auth::user()->isAdmin())
                            <a href="{{ route('Admin.dashboard') }}" class="btn-profil">Mon espace</a>
                            @break
                        @case(Auth::user()->isModerator())
                            <a href="/bord" class="btn-profil">Mon espace</a>
                            @break
                        @case(Auth::user()->isContributeur())
                            <a href="/bord" class="btn-profil">Mon espace</a>
                            @break
                    
                        @default
                            <a href="/" class="btn-profil">Accueil</a>
                    @endswitch
                @endif
            </div>
        </div>
    </div>

    {{-- STATISTIQUES --}}

    @if(Auth::check() && Auth::id() == $user->id)
        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-number">{{ $stats['contenus'] }}</span>
                <span class="stat-label">Contenus publiés</span>
            </div>

            <div class="stat-card">
                <span class="stat-number">{{ $stats['contenus_valides'] }}</span>
                <span class="stat-label">Contenus validés</span>
            </div>

            <div class="stat-card">
                <span class="stat-number">{{ $stats['commentaires'] }}</span>
                <span class="stat-label">Commentaires</span>
            </div>

            <div class="stat-card">
                <span class="stat-number">{{ $stats['contenus_en_attente'] }}</span>
                <span class="stat-label">En attente</span>
            </div>
        </div>
    @endif


    @if($user->contenus->count() > 0)
        <div class="contenus-section">
            <h3 class="section-title">
                <hr>Journal
            </h3>
            <div class="contenus">
                @foreach($user->contenus as $contenu)
                    <div class="contenu">
                        <div class="contenu-header">
                            <h1 class="contenu-titre">{{ $contenu->titre }}</h1>

                            <div class="contenu-meta">
                                <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2ZM16.0043 12.8777C15.6589 12.3533 15.4097 11.9746 14.4622 12.1248C12.6717 12.409 12.4732 12.7224 12.3877 13.2375L12.3636 13.3943L12.3393 13.5597C12.2416 14.2428 12.2453 14.5012 12.5589 14.8308C13.8241 16.1582 14.582 17.115 14.8116 17.6746C14.9237 17.9484 15.2119 18.7751 15.0136 19.5927C16.2372 19.1066 17.3156 18.3332 18.1653 17.3559C18.2755 16.9821 18.3551 16.5166 18.3551 15.9518V15.8472C18.3551 14.9247 18.3551 14.504 17.7031 14.1314C17.428 13.9751 17.2227 13.881 17.0582 13.8064C16.691 13.6394 16.4479 13.5297 16.1198 13.0499C16.0807 12.9928 16.0425 12.9358 16.0043 12.8777ZM12 3.83333C9.68259 3.83333 7.59062 4.79858 6.1042 6.34896C6.28116 6.47186 6.43537 6.64453 6.54129 6.88256C6.74529 7.34029 6.74529 7.8112 6.74529 8.22764C6.74488 8.55621 6.74442 8.8672 6.84992 9.09302C6.99443 9.40134 7.6164 9.53227 8.16548 9.64736C8.36166 9.68867 8.56395 9.73083 8.74797 9.78176C9.25405 9.92233 9.64554 10.3765 9.95938 10.7412C10.0896 10.8931 10.2819 11.1163 10.3783 11.1717C10.4286 11.1356 10.59 10.9608 10.6699 10.6735C10.7307 10.4547 10.7134 10.2597 10.6239 10.1543C10.0648 9.49445 10.0952 8.2232 10.268 7.75495C10.5402 7.01606 11.3905 7.07058 12.012 7.11097C12.2438 7.12589 12.4626 7.14023 12.6257 7.11976C13.2482 7.04166 13.4396 6.09538 13.575 5.91C13.8671 5.50981 14.7607 4.9071 15.3158 4.53454C14.3025 4.08382 13.1805 3.83333 12 3.83333Z">
                                        </path>
                                    </svg> {{ $contenu->getRegion->nom }}</span>
                                <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M18.5 10L22.9 21H20.745L19.544 18H15.454L14.255 21H12.101L16.5 10H18.5ZM10 2V4H16V6L14.0322 6.0006C13.2425 8.36616 11.9988 10.5057 10.4115 12.301C11.1344 12.9457 11.917 13.5176 12.7475 14.0079L11.9969 15.8855C10.9237 15.2781 9.91944 14.5524 8.99961 13.7249C7.21403 15.332 5.10914 16.5553 2.79891 17.2734L2.26257 15.3442C4.2385 14.7203 6.04543 13.6737 7.59042 12.3021C6.46277 11.0281 5.50873 9.57985 4.76742 8.00028L7.00684 8.00037C7.57018 9.03885 8.23979 10.0033 8.99967 10.877C10.2283 9.46508 11.2205 7.81616 11.9095 6.00101L2 6V4H8V2H10ZM17.5 12.8852L16.253 16H18.745L17.5 12.8852Z">
                                        </path>
                                    </svg> {{ $contenu->getLangue->nom }}</span>
                                <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M21 3C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H21ZM9 8C6.792 8 5 9.792 5 12C5 14.208 6.792 16 9 16C10.1 16 11.1 15.55 11.828 14.828L10.4144 13.4144C10.0525 13.7762 9.5525 14 9 14C7.895 14 7 13.105 7 12C7 10.895 7.895 10 9 10C9.55 10 10.0483 10.22 10.4153 10.5866L11.829 9.173C11.1049 8.44841 10.1045 8 9 8ZM16 8C13.792 8 12 9.792 12 12C12 14.208 13.792 16 16 16C17.104 16 18.104 15.552 18.828 14.828L17.4144 13.4144C17.0525 13.7762 16.5525 14 16 14C14.895 14 14 13.105 14 12C14 10.895 14.895 10 16 10C16.553 10 17.0534 10.2241 17.4153 10.5866L18.829 9.173C18.1049 8.44841 17.1045 8 16 8Z">
                                        </path>
                                    </svg> {{ $contenu->getType->libelle }}</span>
                                <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M7 1V3H3C2.44772 3 2 3.44772 2 4V20C2 20.5523 2.44772 21 3 21H10.7546C9.65672 19.6304 9 17.8919 9 16C9 11.5817 12.5817 8 17 8C18.8919 8 20.6304 8.65672 22 9.75463V4C22 3.44772 21.5523 3 21 3H17V1H15V3H9V1H7ZM23 16C23 19.3137 20.3137 22 17 22C13.6863 22 11 19.3137 11 16C11 12.6863 13.6863 10 17 10C20.3137 10 23 12.6863 23 16ZM16 12V16.4142L18.2929 18.7071L19.7071 17.2929L18 15.5858V12H16Z">
                        </path>
                    </svg>{{ $contenu->created_at->format('D M Y') }}</span>
                                <span>💬 {{ $contenu->commentaires->count() }} commentaires</span>
                            </div>
                        </div>
                        @if($contenu->medias->count() > 0)
                            <div class="medias-gallery">
                                @foreach($contenu->medias as $media)
                                    <div class="media-item">
                                        @if($media->estImage())
                                            <img src="{{ $media->url }}" alt="{{ $media->description }}" title="{{ $media->description }}">
                                        @elseif($media->estVideo())
                                            <video controls>
                                                <source src="{{ $media->url }}" type="{{ $media->type }}">
                                                Votre navigateur ne supporte pas la vidéo.
                                            </video>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif


                        <div class="contenu-body">

                            <p class="description">
                                {{ Str::limit(strip_tags($contenu->texte), 150) }}
                                @if(strlen(strip_tags($contenu->texte)) > 150)
                                    <a href="{{ route('contenu.show', $contenu->id) }}" class="read-more">...Lire la suite</a>
                                @endif
                            </p>

                            <a href="{{ route('contenu.show', $contenu->id) }}" class="btn-profil">
                                Commentaires
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        @if (Auth::check() && Auth::id() == $user->id)
            <div class="no-content">
                <p>Vous n'avez encore aucun contenu publié.</p>
            </div>
        @else
            <div class="no-content">
                <p>Cet utilisateur n'a pas encore publié de contenu.</p>
            </div>
        @endif
        
    @endif
</body>

</html>