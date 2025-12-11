document.addEventListener('DOMContentLoaded', function() {
    const menuItem = document.querySelector('.pages li:nth-child(2)'); // Le 2ème élément de menu
    const sousMenu = document.querySelector('.sous-menu');
    
    // Fonction pour fermer le sous-menu
    function closeSousMenu() {
        menuItem.classList.remove('active');
    }
    
    // Fonction pour ouvrir/fermer le sous-menu
    function toggleSousMenu() {
        menuItem.classList.toggle('active');
    }
    
    // Clic sur l'item de menu
    menuItem.addEventListener('click', () =>{
        toggleSousMenu();
    });
    
    // Fermer le sous-menu en cliquant ailleurs
    document.addEventListener('click', function(e) {
        if (!menuItem.contains(e.target)) {
            closeSousMenu();
        }
    });
    
    // Fermer le sous-menu avec la touche Échap
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSousMenu();
        }
    });
    
    // Navigation au clavier pour l'accessibilité
    menuItem.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            toggleSousMenu();
        }
    });
    
});
