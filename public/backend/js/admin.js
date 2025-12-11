// Gestion du formulaire des rôles
const addRoleBtn = document.getElementById('addRoleBtn');
const backBtn = document.getElementById('back');
const roleForm = document.getElementById('roleForm');

// Afficher le formulaire quand on clique sur "addrole"
if (addRoleBtn && roleForm) {
    addRoleBtn.addEventListener('click', function () {
        roleForm.classList.add('active');
    });
}

// Cacher le formulaire quand on clique sur "back"
if (backBtn && roleForm) {
    backBtn.addEventListener('click', function () {
        roleForm.classList.remove('active');
        // Réinitialiser le formulaire
        const form = roleForm.querySelector('form');
        if (form) {
            form.reset();
        }
    });
}

// Gestion des messages flash (succès/erreurs)
const alerts = document.querySelectorAll('.alert');
alerts.forEach(alert => {
    setTimeout(() => {
        alert.style.opacity = '0';
        alert.style.transition = 'opacity 0.5s ease';
        setTimeout(() => alert.remove(), 500);
    }, 3000);
});

document.querySelectorAll('.utilisateur').forEach(utilisateur => {
        utilisateur.addEventListener('click', () =>{
            utilisateurid =utilisateur.dataset.id;
            selectUser(utilisateur);
        document.getElementById('nom').textContent = `${utilisateur.dataset.prenom} ${utilisateur.dataset.nom}`;
        document.getElementById('detailrole').textContent = utilisateur.dataset.role ;
        document.getElementById('statut').textContent = utilisateur.dataset.statut ;
        document.getElementById('sexe').textContent = utilisateur.dataset.sexe ;
        document.getElementById('email').textContent = utilisateur.dataset.email ;
        document.getElementById('langue').textContent = utilisateur.dataset.langue ;
        document.getElementById('region').textContent = utilisateur.dataset.region ;
        document.getElementById('date').textContent = utilisateur.dataset.date ;
        document.getElementById('heure').textContent = utilisateur.dataset.heure ;
        document.getElementById('pht').src = `{{ asset('storage/' . ${utilisateur.dataset.photo} ) }}` ;

        // Afficher le détail avec animation
    const details = document.querySelector('.detail')
    
    setTimeout(() => {
        details.classList.add('show');
    }, 10);
        })
    })


// =============================================
// GESTION DES UTILISATEURS
// =============================================

function selectUser(element) {
    
    // Retirer la classe active de tous les utilisateurs
    document.querySelectorAll('.utilisateur').forEach(user => {
        user.classList.remove('select');
    });
    
    // Ajouter la classe active à l'utilisateur sélectionné
    element.classList.add('select');

}









// =============================================
// GESTION DES ÉVÉNEMENTS GLOBAUX
// =============================================

document.addEventListener('click', function(e) {
    const details = document.querySelector('.detail');
    
    // Cacher le détail utilisateur si on clique en dehors
    if (details && !e.target.closest('.utilisateur') && !e.target.closest('.detail') && !e.target.closest('.roles')) {
        details.classList.remove('show');
        

        
        document.querySelectorAll('.utilisateur').forEach(user => {
            user.classList.remove('select');
        });
    }
    
});


// =============================================
// EXPORT POUR USAGE GLOBAL
// =============================================

window.selectUser = selectUser;