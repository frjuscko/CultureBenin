<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/login.css') }}">
    <title>Modifier mon profil - Culture Bénin</title>
    <style>
        .edit-profil-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .profil-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .avatar-upload {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }
        
        .avatar-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #f0f0f0;
            transition: all 0.3s;
        }
        
        .avatar-upload:hover .avatar-preview {
            border-color: #39C252;
            transform: scale(1.05);
        }
        
        .avatar-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .avatar-upload:hover .avatar-overlay {
            opacity: 1;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group.full-width {
            grid-column: 1 / -1;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        
        input, select, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #39C252;
            color: #2da042;
        }
        
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: #39C252;
            color: white;
        }
        
        .btn-primary:hover {
            background: #2da042;
        }
        
        .btn-secondary {
            background: #f0f0f0;
            color: #333;
            margin-right: 15px;
        }
        
        .btn-secondary:hover {
            background: #e0e0e0;
        }
        
        .actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #eee;
        }
        
        .password-toggle {
            position: relative;
        }
        
        .password-toggle input {
            padding-right: 45px;
        }
        
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
        }
        
        .file-input {
            display: none;
        }
        
        .current-photo {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .photo-info {
            font-size: 0.9em;
            color: #666;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="edit-profil-container">
        <div class="profil-header">
            <h1>✏️ Modifier mon profil</h1>
            <p>Mettez à jour vos informations personnelles</p>
        </div>
        
        <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            {{-- PHOTO DE PROFIL --}}
            <div class="form-group full-width">
                <div class="current-photo">
                    <label>Photo de profil actuelle</label>
                    <div class="avatar-upload" onclick="document.getElementById('photo').click()">
                        <img src="{{ asset('storage/'.Auth::user()->photo) }}" alt="{{ Auth::user()->prenom }}" 
                             alt="Photo de profil" 
                             class="avatar-preview" 
                             id="avatarPreview">
                        <div class="avatar-overlay">
                            <span>📷 Changer</span>
                        </div>
                    </div>
                    <input type="file" id="photo" name="photo" 
                           accept="image/*" class="file-input"
                           onchange="previewImage(event)">
                    <p class="photo-info">
                        Cliquez sur la photo pour la changer.<br>
                        Formats acceptés : JPG, PNG, GIF (max 2MB)
                    </p>
                </div>
            </div>
            
            <div class="form-grid">
                {{-- NOM --}}
                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" id="nom" name="nom" 
                           value="{{ old('nom', Auth::user()->nom) }}" required>
                </div>
                
                {{-- PRÉNOM --}}
                <div class="form-group">
                    <label for="prenom">Prénom *</label>
                    <input type="text" id="prenom" name="prenom" 
                           value="{{ old('prenom', Auth::user()->prenom) }}" required>
                </div>
                
                {{-- EMAIL --}}
                <div class="form-group full-width">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" 
                           value="{{ old('email', Auth::user()->email) }}" required>
                </div>
                
                {{-- GENRE --}}
                <div class="form-group">
                    <label for="sexe">Genre *</label>
                    <select id="sexe" name="sexe" required>
                        <option value="Masculin" {{ Auth::user()->sexe == 'Masculin' ? 'selected' : '' }}>Masculin</option>
                        <option value="Féminin" {{ Auth::user()->sexe == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                    </select>
                </div>
                
                {{-- LANGUE --}}
                <div class="form-group">
                    <label for="langue">Langue préférée</label>
                    <select id="langue" name="langue">
                        <option value="">Sélectionnez une langue</option>
                        @foreach($langues as $langue)
                            <option value="{{ $langue->id }}" 
                                {{ Auth::user()->langue == $langue->id ? 'selected' : '' }}>
                                {{ $langue->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                {{-- RÉGION --}}
                <div class="form-group">
                    <label for="region">Région</label>
                    <select id="region" name="region">
                        <option value="">Sélectionnez une région</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" 
                                {{ Auth::user()->region == $region->id ? 'selected' : '' }}>
                                {{ $region->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                {{-- BIOGRAPHIE --}}
                <div class="form-group full-width">
                    <label for="bio">Biographie (optionnel)</label>
                    <textarea id="bio" name="bio" rows="4" 
                              placeholder="Parlez un peu de vous...">{{ old('bio', Auth::user()->bio ?? '') }}</textarea>
                </div>
                
                {{-- MOT DE PASSE (optionnel) --}}
                <div class="form-group full-width">
                    <h3>🔐 Modifier le mot de passe</h3>
                    <p class="photo-info">Laissez vide si vous ne voulez pas changer</p>
                    
                    <div class="password-toggle">
                        <label for="current_password">Mot de passe actuel</label>
                        <input type="password" id="current_password" name="current_password">
                        <button type="button" class="toggle-password" onclick="togglePassword('current_password')">
                            👁️
                        </button>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <div class="password-toggle">
                                <label for="new_password">Nouveau mot de passe</label>
                                <input type="password" id="new_password" name="new_password">
                                <button type="button" class="toggle-password" onclick="togglePassword('new_password')">
                                    👁️
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="password-toggle">
                                <label for="new_password_confirmation">Confirmer le nouveau mot de passe</label>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation">
                                <button type="button" class="toggle-password" onclick="togglePassword('new_password_confirmation')">
                                    👁️
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- ACTIONS --}}
            <div class="actions">
                <a href="{{ route('profil', Auth::id()) }}" class="btn btn-secondary">
                    Annuler
                </a>
                <button type="submit" class="btn btn-primary">
                    💾 Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
    
    <script>
        // Prévisualisation de l'image
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('avatarPreview');
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
        
        // Toggle affichage mot de passe
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
        }
        
        // Génère un aperçu de l'avatar par défaut
        function generateAvatarPreview() {
            const nom = document.getElementById('nom').value;
            const prenom = document.getElementById('prenom').value;
            
            if (prenom) {
                const initiale = prenom.charAt(0).toUpperCase();
                const couleurs = ['#39C252', '#4A90E2', '#F5A623', '#7B61FF', '#FF4757'];
                const couleur = couleurs[Math.floor(Math.random() * couleurs.length)];
                
                const svg = `<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg">
                    <rect width="200" height="200" fill="${couleur}"/>
                    <text x="100" y="120" font-family="Arial, sans-serif" 
                          font-size="80" fill="white" text-anchor="middle" 
                          font-weight="bold">${initiale}</text>
                </svg>`;
                
                return 'data:image/svg+xml;base64,' + btoa(svg);
            }
            
            return null;
        }
        
        // Met à jour l'aperçu de l'avatar quand le nom/prénom change
        document.getElementById('nom').addEventListener('input', updateAvatarPreview);
        document.getElementById('prenom').addEventListener('input', updateAvatarPreview);
        
        function updateAvatarPreview() {
            const avatarPreview = document.getElementById('avatarPreview');
            const fileInput = document.getElementById('photo');
            
            // Ne met à jour que si aucun fichier n'est sélectionné
            if (fileInput.files.length === 0) {
                const newAvatar = generateAvatarPreview();
                if (newAvatar) {
                    avatarPreview.src = newAvatar;
                }
            }
        }
    </script>
</body>
</html>