@extends('frontend')
@section('content')
    <div class="hero-section">
        <div class="carousel-slides">
            <div class="carousel-slide slide-1 active">
                <h2 class="slide-title">Découvrez le Bénin et sa culture</h2>
                <p class="slide-text">Une plateforme web participative permettant de
                    documenter,
                    valoriser et diffuser la culture béninoise.</p>
                <a href="#" class="btn">Commencez la visite</a>
            </div>
            <div class="carousel-slide slide-2">
                <h2 class="slide-title">Nos langues, nos terroirs</h2>
                <p class="slide-text">Explorez la diversité culturelle à travers les régions du Bénin et créez des contenus
                    dans vos langues locales préférées.</p>
                <a href="#" class="btn">Explorer les régions</a>
            </div>
            <div class="carousel-slide slide-3">
                <h2 class="slide-title">Votre savoir nous enrichit</h2>
                <p class="slide-text">Partagez contes, recettes et traditions de votre région. Chaque contribution préserve
                    notre héritage pour les générations futures.</p>
                <a href="#" class="btn">Participer</a>
            </div>
        </div>
        <button class="carousel-btn prev-btn">
            &#10094;
        </button>
        <button class="carousel-btn next-btn">
            &#10095;
        </button>

        <div class="carousel-nav">
            <div class="nav-dot active" data-slide="0"></div>
            <div class="nav-dot" data-slide="1"></div>
            <div class="nav-dot" data-slide="2"></div>
        </div>
    </div>

    <div class="about" id="about">
        <div class="part-left">
            <div class="top">
                <h3 class="section-title">
                    <hr>À propos
                </h3>
                <h1 class="grand-title">Notre Héritage, Notre
                    Fierté</h1>
                <p class="section-text">Cette plateforme est dédiée à la
                    préservation et à la
                    célébration de la richesse culturelle du
                    <span>Bénin</span>. Nous
                    documentons ensemble les traditions, <a href>langues</a> et
                    savoirs ancestraux pour les générations futures.
                </p>
                <p class="section-text">Rejoignez notre communauté pour
                    partager, découvrir et faire vivre notre patrimoine
                    commun.</p>
                <p class="sous-title">Une mémoire collective à
                    préserver, un héritage à transmettre</p>
            </div>
            <div class="down"></div>
        </div>
        <div class="part-right">
            <img src="{{ URL::asset('Logo/Logo CB.PNG') }}" alt="">
        </div>
    </div>

    <div class="contenus">
        <div class="title-zone">
            <h3 class="section-title">
                <hr>À la une
            </h3>
            <h1 class="grand-title">Trésors culturels à découvrir</h1>
            <p class="section-text">Plongez au cœur de la richesse
                culturelle béninoise avec ces contenus sélectionnés pour
                vous. Des histoires qui traversent les générations, des
                saveurs qui racontent nos terroirs, des savoir-faire qui
                honorent nos ancêtres.</p>
        </div>
        @if ($contenus->count() > 0)
            <div class="contenu-cards">
                @foreach ($contenus as $contenu)
                    <div class="contenu-card">
                        
                        <div class="image">
                            @if($contenu->medias->count() > 0)
                    @php $media = $contenu->medias->first() @endphp
                    @if($media->estImage())
                        <img src="{{ $media->url }}" alt="{{ $contenu->titre }}" class="contenu-image">
                    @elseif($media->estVideo())
                        <div class="video-placeholder">
                            🎬 Vidéo disponible
                        </div>
                    @endif
                @else
                    <div class="no-image">🖼️</div>
                @endif
                        </div>
                        <div class="texte">
                            <h3 class="categorie">{{ $contenu->getType->libelle }}</h3>
                            <h1 class="titre">{{ $contenu->titre }}</h1>
                            <p class="description">
                        {{ Str::limit(strip_tags($contenu->texte), 150) }}
                        @if(strlen(strip_tags($contenu->texte)) > 150)
                            <a href="{{ route('contenu.show', $contenu->id) }}" class="read-more">...Lire la suite</a>
                        @endif
                    </p>
                        </div>
                        <div class="down">
                            <h3 class="date">{{ $contenu->created_at->format('d M Y') }}</h3>
                            <button><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12.001 4.52853C14.35 2.42 17.98 2.49 20.2426 4.75736C22.5053 7.02472 22.583 10.637 20.4786 12.993L11.9999 21.485L3.52138 12.993C1.41705 10.637 1.49571 7.01901 3.75736 4.75736C6.02157 2.49315 9.64519 2.41687 12.001 4.52853Z">
                                    </path>
                                </svg></button>
                            <p>0</p>
                            <button><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M10 3H14C18.4183 3 22 6.58172 22 11C22 15.4183 18.4183 19 14 19V22.5C9 20.5 2 17.5 2 11C2 6.58172 5.58172 3 10 3Z">
                                    </path>
                                </svg></button>
                            <p>{{ $contenu->commentaires->count() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Message si aucun contenu -->
            <div style="text-align: center; padding: 40px; background: #f8f9fa; border-radius: 10px;">
                <h3>Aucun contenu disponible pour le moment</h3>
                <p>Soyez le premier à publier !</p>
                @auth
                    <a href="{{ route('AjoutContenu') }}" class="btn-two" style="margin-top: 20px; display: inline-block;">
                        Publier un contenu
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-two" style="margin-top: 20px; display: inline-block;">
                        Connectez-vous pour publier
                    </a>
                @endauth
            </div>
        @endif
    </div>
    <div class="langues-section">
        <div class="part-left">
            <div class="top">
                <h3 class="section-title">
                    <hr>Nos langues
                </h3>
                <h1 class="grand-title">Nos langues, pont entre les
                    générations</h1>
                <p class="section-text">Le Fon, le Yoruba, le Goun, le
                    Dendi... Autant de langues qui portent en elles
                    notre histoire et notre vision du monde. Découvrez
                    des contenus créés directement dans nos langues
                    nationales.</p>
            </div>
            <div class="down">
                <p>Plus de <span>500</span> contes disponibles en
                    <span>Fon</span>
                </p>
                <p><span>78</span> recettes traditionnelles en
                    <span>Yoruba</span>
                </p>
                <p><span>45</span> articles culturels en
                    <span>Goun</span>
                </p>
            </div>
        </div>
        <div class="part-right"></div>
    </div>
    <div class="regions-section">
        <div class="title-zone">
            <h3 class="section-title">
                <hr>Nos régions
            </h3>
            <h1 class="grand-title">Voyagez à travers les 12
                départements</h1>
            <p class="section-text">Chaque région du Bénin possède son
                identité culturelle unique. Cliquez sur la carte pour
                découvrir les traditions spécifiques à chaque terroir,
                des contes du Nord aux pratiques culinaires du Sud.</p>
            <p class="sous-title">Votre région n'est pas assez
                représentée ? Devenez <a href>contributeur</a> et
                partagez vos connaissances !</p>
        </div>
    </div>
    <div class="invite-section">
        <div class="title-zone">
            <h3 class="section-title">
                <hr>Comment contribuer
            </h3>
            <h1 class="grand-title">Votre savoir mérite d'être partagé !</h1>
        </div>
        <div class="invite-text">
            <p class="step">Inscrivez-vous en 2 minutes</p>
            <p class="sous-title">Rejoignez notre communauté de passionnés de culture béninoise</p>
            <p class="step">Partagez vos connaissances</p>
            <p class="sous-title">Racontez une histoire, une recette, décrire une tradition... Dans votre langue !</p>
            <p class="step">Soyez publié et reconnu</p>
            <p class="sous-title">Après validation, votre contenu enrichit notre patrimoine commun.</p>
            <a href="" class="btn-two">Devenez contributeur <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                        d="M17.841 15.659L18.017 15.836L18.1945 15.659C19.0732 14.7803 20.4978 14.7803 21.3765 15.659C22.2552 16.5377 22.2552 17.9623 21.3765 18.841L18.0178 22.1997L14.659 18.841C13.7803 17.9623 13.7803 16.5377 14.659 15.659C15.5377 14.7803 16.9623 14.7803 17.841 15.659ZM12 14V22H4C4 17.6651 7.44784 14.1355 11.7508 14.0038L12 14ZM12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1Z">
                    </path>
                </svg></a>
        </div>
    </div>
    <div class="stats-section">
        <div class="title-zone">
            <h3 class="section-title">
                <hr>Chiffres clés
            </h3>
            <h1 class="grand-title">Une aventure collective qui
                grandit</h1>
        </div>
        <div class="stats">
            <div class="stat">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M20 22H4C3.44772 22 3 21.5523 3 21V3C3 2.44772 3.44772 2 4 2H20C20.5523 2 21 2.44772 21 3V21C21 21.5523 20.5523 22 20 22ZM7 6V10H11V6H7ZM7 12V14H17V12H7ZM7 16V18H17V16H7ZM13 7V9H17V7H13Z">
                    </path>
                </svg>
                <p>{{ $contenus->count() }} contenus culturels validés</p>
            </div>
            <div class="stat">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M17.841 15.659L18.017 15.836L18.1945 15.659C19.0732 14.7803 20.4978 14.7803 21.3765 15.659C22.2552 16.5377 22.2552 17.9623 21.3765 18.841L18.0178 22.1997L14.659 18.841C13.7803 17.9623 13.7803 16.5377 14.659 15.659C15.5377 14.7803 16.9623 14.7803 17.841 15.659ZM12 14V22H4C4 17.6651 7.44784 14.1355 11.7508 14.0038L12 14ZM12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1Z">
                    </path>
                </svg>
                <p>{{ $contributeurs->count() }} contributeurs actifs</p>
            </div>
            <div class="stat">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M18.5 10L22.9 21H20.745L19.544 18H15.454L14.255 21H12.101L16.5 10H18.5ZM10 2V4H16V6L14.0322 6.0006C13.2425 8.36616 11.9988 10.5057 10.4115 12.301C11.1344 12.9457 11.917 13.5176 12.7475 14.0079L11.9969 15.8855C10.9237 15.2781 9.91944 14.5524 8.99961 13.7249C7.21403 15.332 5.10914 16.5553 2.79891 17.2734L2.26257 15.3442C4.2385 14.7203 6.04543 13.6737 7.59042 12.3021C6.46277 11.0281 5.50873 9.57985 4.76742 8.00028L7.00684 8.00037C7.57018 9.03885 8.23979 10.0033 8.99967 10.877C10.2283 9.46508 11.2205 7.81616 11.9095 6.00101L2 6V4H8V2H10ZM17.5 12.8852L16.253 16H18.745L17.5 12.8852Z">
                    </path>
                </svg>
                <p>{{ $langues->count() }} langues nationales représentées</p>
            </div>
            <div class="stat">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2ZM16.0043 12.8777C15.6589 12.3533 15.4097 11.9746 14.4622 12.1248C12.6717 12.409 12.4732 12.7224 12.3877 13.2375L12.3636 13.3943L12.3393 13.5597C12.2416 14.2428 12.2453 14.5012 12.5589 14.8308C13.8241 16.1582 14.582 17.115 14.8116 17.6746C14.9237 17.9484 15.2119 18.7751 15.0136 19.5927C16.2372 19.1066 17.3156 18.3332 18.1653 17.3559C18.2755 16.9821 18.3551 16.5166 18.3551 15.9518V15.8472C18.3551 14.9247 18.3551 14.504 17.7031 14.1314C17.428 13.9751 17.2227 13.881 17.0582 13.8064C16.691 13.6394 16.4479 13.5297 16.1198 13.0499C16.0807 12.9928 16.0425 12.9358 16.0043 12.8777ZM12 3.83333C9.68259 3.83333 7.59062 4.79858 6.1042 6.34896C6.28116 6.47186 6.43537 6.64453 6.54129 6.88256C6.74529 7.34029 6.74529 7.8112 6.74529 8.22764C6.74488 8.55621 6.74442 8.8672 6.84992 9.09302C6.99443 9.40134 7.6164 9.53227 8.16548 9.64736C8.36166 9.68867 8.56395 9.73083 8.74797 9.78176C9.25405 9.92233 9.64554 10.3765 9.95938 10.7412C10.0896 10.8931 10.2819 11.1163 10.3783 11.1717C10.4286 11.1356 10.59 10.9608 10.6699 10.6735C10.7307 10.4547 10.7134 10.2597 10.6239 10.1543C10.0648 9.49445 10.0952 8.2232 10.268 7.75495C10.5402 7.01606 11.3905 7.07058 12.012 7.11097C12.2438 7.12589 12.4626 7.14023 12.6257 7.11976C13.2482 7.04166 13.4396 6.09538 13.575 5.91C13.8671 5.50981 14.7607 4.9071 15.3158 4.53454C14.3025 4.08382 13.1805 3.83333 12 3.83333Z">
                    </path>
                </svg>
                <p>{{ $regions->count() }} régions du Bénin couvertes</p>
            </div>
        </div>
    </div>


    <script src="{{ URL::asset('frontend/js/herosection.js') }}"></script>
@endsection