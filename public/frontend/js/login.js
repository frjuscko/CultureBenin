const pass = document.getElementById('pass');
const password = document.getElementById('password');
const submit = document.getElementById('reg');



reg.disabled = true;

document.querySelector('.reg-btn').addEventListener('click', () =>{
    document.querySelector('.slides').style.transform = "translateX(-100%)";
    document.querySelector('.container').classList.add('active');
})

document.querySelector('.log-btn').addEventListener('click', () =>{
    document.querySelector('.slides').style.transform = "translateX(0)";
    document.querySelector('.container').classList.remove('active');
})

pass.addEventListener('input', () => {
    const barre = document.getElementById('barre');
    const nombre = document.getElementById('nombre');
    const majuscule = document.getElementById('maj');
    const chiffre = document.getElementById('chiffre');
    const special = document.getElementById('special');

    let cpt = 0;

    // Vérifier la longueur    
    if (pass.value.length >= 8) {
        cpt += 25;
        nombre.style.color = '#28a745';
    } else {
        nombre.style.color = '#5e7263ff';
    }

    // Vérifier les majuscules
    if (/[A-Z]/.test(pass.value)) {
        cpt += 25;
        majuscule.style.color = '#28a745';
    } else {
        majuscule.style.color = '#5e7263ff';
    }

    // Vérifier les chiffres
    if (/[0-9]/.test(pass.value)) {
        cpt += 25;
        chiffre.style.color = '#28a745';
    } else {
        chiffre.style.color = '#5e7263ff';
    }

    // Vérifier les caractères spéciaux
    if (/[^A-Za-z0-9]/.test(pass.value)) {
        cpt += 25;
        special.style.color = '#28a745';
    } else {
        special.style.color = '#5e7263ff';
    }

    barre.style.width = (cpt) + "%";

    if (cpt < 50) {
        barre.style.backgroundColor = '#dc3545'; // Rouge    
    } else if (cpt < 75) {
        barre.style.backgroundColor = '#ffc107'; // Jaune 
    } else {
        barre.style.backgroundColor = '#28a745'; // Vert
    }
})

password.addEventListener('blur', () => {
    if (password.value === pass.value) {
        reg.disabled = false;
    } else {
        alert('Les mots de passe ne correspondent pas !');
        password.value = "";
    }
})

// Gestion des messages flash (succès/erreurs)
const alerts = document.querySelectorAll('.alert');
alerts.forEach(alert => {
    setTimeout(() => {
        alert.style.opacity = '0';
        alert.style.transition = 'opacity 0.5s ease';
        setTimeout(() => alert.remove(), 500);
    }, 3000);
});