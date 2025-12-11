let navbar = document.querySelector('.navbar');
let mobilebtn = document.querySelector('.mobile-btn');
let mobilemenu = document.querySelector('.mobile-menu');

window.addEventListener('scroll', () => {
    if (window.scrollY > 70) {
        navbar.classList.add('scrolled')
    } else {
        navbar.classList.remove('scrolled')
    }
})

mobilebtn.addEventListener('click', () => {
    mobilemenu.classList.toggle('visible');
})
