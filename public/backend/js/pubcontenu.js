document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('fileList');
    
    let files = [];
    
    // Gestion des événements de glisser-déposer
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('active');
    });
    
    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('active');
    });
    
    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('active');
        
        if (e.dataTransfer.files.length) {
            handleFiles(e.dataTransfer.files);
        }
    });
    
    // Gestion du clic sur la zone d'upload
    uploadArea.addEventListener('click', () => {
        fileInput.click();
    });
    
    // Gestion de la sélection de fichiers via le input
    fileInput.addEventListener('change', () => {
        if (fileInput.files.length) {
            handleFiles(fileInput.files);
        }
    });
    
    // Fonction pour traiter les fichiers sélectionnés
    function handleFiles(newFiles) {
        const maxSize = 10 * 1024 * 1024; // 10MB en bytes
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'video/mp4', 'video/avi', 'video/quicktime'];
        
        for (let i = 0; i < newFiles.length; i++) {
            const file = newFiles[i];
            
            // Vérification du type de fichier
            if (!allowedTypes.includes(file.type)) {
                alert(`Le fichier "${file.name}" n'est pas d'un format accepté.`);
                continue;
            }
            
            // Vérification de la taille du fichier
            if (file.size > maxSize) {
                alert(`Le fichier "${file.name}" dépasse la taille maximale de 10MB.`);
                continue;
            }
            
            // Ajouter le fichier à la liste
            if (!files.some(f => f.name === file.name && f.size === file.size)) {
                files.push(file);
            }
        }
        
        updateFileList();
        updateFileInput();
    }
    
    // Mettre à jour l'affichage de la liste des fichiers
    function updateFileList() {
        fileList.innerHTML = '';
        
        if (files.length === 0) {
            const emptyMessage = document.createElement('div');
            emptyMessage.className = 'upload-subtext';
            emptyMessage.textContent = 'Aucun fichier sélectionné';
            fileList.appendChild(emptyMessage);
            return;
        }
        
        files.forEach((file, index) => {
            const fileItem = document.createElement('div');
            fileItem.className = 'file-item';
            
            // Déterminer l'icône en fonction du type de fichier
            let fileIcon = 'fa-file';
            if (file.type.startsWith('image/')) {
                fileIcon = 'fa-file-image';
            } else if (file.type.startsWith('video/')) {
                fileIcon = 'fa-file-video';
            }
            
            // Formater la taille du fichier
            const fileSize = formatFileSize(file.size);
            
            fileItem.innerHTML = `
                <div class="file-icon">
                    <i class="fas ${fileIcon}"></i>
                </div>
                <div class="file-info">
                    <div class="file-name">${file.name}</div>
                    <div class="file-size">${fileSize}</div>
                </div>
                <div class="remove-file" data-index="${index}">
                    <i class="fas fa-times"></i>
                </div>
            `;
            
            fileList.appendChild(fileItem);
        });
        
        // Ajouter des écouteurs d'événements pour les boutons de suppression
        document.querySelectorAll('.remove-file').forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                const index = parseInt(button.getAttribute('data-index'));
                files.splice(index, 1);
                updateFileList();
                updateFileInput();
            });
        });
    }
    
    // Formater la taille du fichier
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
    
    // Mettre à jour le input file avec les fichiers sélectionnés
    function updateFileInput() {
        // Créer un nouveau DataTransfer pour mettre à jour les fichiers
        const dataTransfer = new DataTransfer();
        
        // Ajouter chaque fichier au DataTransfer
        files.forEach(file => {
            dataTransfer.items.add(file);
        });
        
        // Mettre à jour les fichiers du input
        fileInput.files = dataTransfer.files;
    }
    
    // Initialiser l'affichage
    updateFileList();
});