@extends('backend.admin')
@section('content')

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


    <div class="utilisateurs">
        <div class="search-bar">
            <form action="{{ route('utilisateurs') }}" method="GET">
                <input type="text" name="search" value="{{ $search }}" placeholder="Rechercher un utilisateur..."
                    class="search-input">
                <button type="submit" class="search-btn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 14V22H4C4 17.5817 7.58172 14 12 14ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM21.4462 20.032L22.9497 21.5355L21.5355 22.9497L20.032 21.4462C19.4365 21.7981 18.7418 22 18 22C15.7909 22 14 20.2091 14 18C14 15.7909 15.7909 14 18 14C20.2091 14 22 15.7909 22 18C22 18.7418 21.7981 19.4365 21.4462 20.032ZM18 20C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16C16.8954 16 16 16.8954 16 18C16 19.1046 16.8954 20 18 20Z"></path></svg></button>
            </form>
        </div>
        @foreach ($users as $user)
            <div class="utilisateur" data-user-id="{{ $user->id }}" data-nom="{{ $user->nom }}"
                data-prenom="{{ $user->prenom }}" data-email="{{ $user->email }}" data-sexe="{{ $user->sexe }}"
                data-langue="{{ $user->getLangue->nom ? $user->getLangue->nom : 'Non spécifié' }}"
                data-region="{{ $user->getRegion->nom }}" data-statut="{{ $user->statut }}"
                data-role="{{ $user->getRole->libelle }}" data-date="{{ $user->created_at->format('d M Y') }}"
                data-heure="{{ $user->created_at->format('H:i') }}" data-photo="{{ $user->photo }}">
                <div class="date">
                    <h4>{{ $user->created_at->format('d M Y') }}</h4>
                    <p class="details">{{ $user->created_at->format('H:i') }}</p>
                </div>

                <div class="infos">
                    <div class="photo">
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->prenom }}"
                        style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                    </div>
                    <div class="info">
                        <p>{{ $user->prenom }} {{ $user->nom }}</p>
                        <p class="details"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M18.364 17.364L12 23.7279L5.63604 17.364C2.12132 13.8492 2.12132 8.15076 5.63604 4.63604C9.15076 1.12132 14.8492 1.12132 18.364 4.63604C21.8787 8.15076 21.8787 13.8492 18.364 17.364ZM12 15C14.2091 15 16 13.2091 16 11C16 8.79086 14.2091 7 12 7C9.79086 7 8 8.79086 8 11C8 13.2091 9.79086 15 12 15ZM12 13C10.8954 13 10 12.1046 10 11C10 9.89543 10.8954 9 12 9C13.1046 9 14 9.89543 14 11C14 12.1046 13.1046 13 12 13Z">
                                </path>
                            </svg>{{ $user->getRegion->nom }}</p>
                    </div>
                </div>

                <div class="statut">
                    <p class="fonction">{{ $user->getRole ? $user->getRole->libelle : 'Aucun rôle' }}</p>
                    <p class="{{ $user->getStatutClasse() }}"><span>●</span> {{ ucfirst($user->statut) }}</p>
                </div>
                <div class="actions"></div>
            </div>
        @endforeach
        {{-- PAGINATION LARAVEL NATIVE --}}
        <div class="pagination">
            {{ $users->links('vendor.pagination.custom') }}
        </div>
    </div>
    <div class="roles">
        <div class="role-form" id="roleForm">
            <form action="{{ route('role.store') }}" method="POST">
                @csrf
                <div class="input-box">
                    <input type="text" name="libelle" required>
                    <label for="">Rôle</label>
                </div>
                <div class="btns">
                    <button id="back"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 10.5858L9.17157 7.75736L7.75736 9.17157L10.5858 12L7.75736 14.8284L9.17157 16.2426L12 13.4142L14.8284 16.2426L16.2426 14.8284L13.4142 12L16.2426 9.17157L14.8284 7.75736L12 10.5858Z">
                            </path>
                        </svg></button>
                    <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M14 14.252V22H4C4 17.5817 7.58172 14 12 14C12.6906 14 13.3608 14.0875 14 14.252ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM18 17V14H20V17H23V19H20V22H18V19H15V17H18Z">
                            </path>
                        </svg></button>
                </div>
            </form>
        </div>
        <div class="titre">
            <h5>Rôles</h5>
            <button class="addrole" id="addRoleBtn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                        d="M14 14.252V22H4C4 17.5817 7.58172 14 12 14C12.6906 14 13.3608 14.0875 14 14.252ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM18 17V14H20V17H23V19H20V22H18V19H15V17H18Z">
                    </path>
                </svg></button>
        </div>
        @foreach ($roles as $role)
            <div class="role">
                <h4>{{ $role->libelle }}</h4>
                <p>{{ $role->users_count }}</p>
            </div>
        @endforeach
    </div>

    <div class="detail" id="userDetail">
        <div class="image">
            <img src="" id="pht" 
                            style="width: 120px; height: 120px; border-radius: 50%;">
        </div>
        <div class="texte">
            <h3 id="nom"></h3>
            <p><span class="details">Role:</span> <span id="detailrole"></span></p>
            <p><span class="details">Statut:</span> <span id="statut"></span></p>
            <p><span class="details">Sexe:</span> <span id="sexe"></span></p>
            <p><span class="details">Email:</span> <span id="email"></span></p>
            <p><span class="details">Langue:</span> <span id="langue"></span></p>
            <p><span class="details">Région:</span> <span id="region"></span></p>
            <p><span class="details">Inscrit le</span> <span id="date"></span> <span class="details">à</span> <span
                    id="heure"></span></p>
        </div>
    </div>

    {{-- Inclure le fichier JavaScript --}}
    <script src="{{ URL::asset('backend/js/admin.js') }}"></script>



@endsection