// Gestion du formulaire des rôles
document.addEventListener('DOMContentLoaded', function() {
    const addlanguebtn = document.getElementById('addlanguebtn');
    const backBtn = document.getElementById('back');
    const container = document.getElementById('container');

    // Afficher le formulaire quand on clique sur "addlanguebtn"
    if (addlanguebtn && container) {
        addlanguebtn.addEventListener('click', function() {
            container.classList.add('active');
        });
    }

    // Cacher le formulaire quand on clique sur "back"
    if (backBtn && container) {
        backBtn.addEventListener('click', function() {
            container.classList.remove('active');
            // Réinitialiser le formulaire
            const form = container.querySelector('form');
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

});