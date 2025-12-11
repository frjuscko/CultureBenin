document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelector('.carousel-slides');
    const slideElements = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.nav-dot');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const autoPlayToggle = document.getElementById('autoPlayToggle');

    let currentSlide = 0;
    let autoPlayInterval;
    const slideCount = slideElements.length;
    const slideInterval = 5000; // 5 secondes

    // Fonction pour activer l'animation d'une slide
    function activateSlideAnimation(slideIndex) {
        // Réinitialiser toutes les animations
        slideElements.forEach(slide => {
            slide.classList.remove('active');
        });

        // Activer l'animation pour la slide courante
        slideElements[slideIndex].classList.add('active');
    }

    // Fonction pour passer à une diapositive spécifique
    function goToSlide(slideIndex) {
        currentSlide = slideIndex;
        slides.style.transform = `translateX(-${currentSlide * 25}%)`;

        // Activer l'animation pour la nouvelle slide
        activateSlideAnimation(currentSlide);

        // Mettre à jour les indicateurs
        dots.forEach(dot => dot.classList.remove('active'));
        dots[currentSlide].classList.add('active');
    }

    // Fonction pour passer à la diapositive suivante
    function nextSlide() {
        currentSlide = (currentSlide + 1) % slideCount;
        goToSlide(currentSlide);
    }

    // Fonction pour passer à la diapositive précédente
    function prevSlide() {
        currentSlide = (currentSlide - 1 + slideCount) % slideCount;
        goToSlide(currentSlide);
    }

    // Démarrage du défilement automatique
    function startAutoPlay() {
        autoPlayInterval = setInterval(nextSlide, slideInterval);
    }

    // Arrêt du défilement automatique
    function resetAutoPlay() {
        clearInterval(autoPlayInterval);
        startAutoPlay();
    }

    // Événements pour les boutons de navigation
    nextBtn.addEventListener('click', function () {
        nextSlide();
        // Redémarrer le défilement automatique après une interaction manuelle
        resetAutoPlay();
    });

    prevBtn.addEventListener('click', function () {
        prevSlide();
        // Redémarrer le défilement automatique après une interaction manuelle
        resetAutoPlay();
    });

    // Événements pour les indicateurs de diapositive
    dots.forEach(dot => {
        dot.addEventListener('click', function () {
            const slideIndex = parseInt(this.getAttribute('data-slide'));
            goToSlide(slideIndex);
            // Redémarrer le défilement automatique après une interaction manuelle
            resetAutoPlay();
        });
    });

    // Démarrer le défilement automatique au chargement de la page
    startAutoPlay();
})