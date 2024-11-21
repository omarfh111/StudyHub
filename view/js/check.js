//addEventListener
const forum = document.getElementById('registerform');
forum.addEventListener('submit', function (event) {
    let isValid = true;
    let nom = document.getElementById('nom');
    let prenom = document.getElementById('prenom');
    let naissance = document.getElementById('naissance');
    let tel = document.getElementById('tel');
    let email = document.getElementById('email');
    let mdp = document.getElementById('mdp');
    //let confirmermdp = document.getElementById('confirmermdp');
    clearMessages();

    if (nom.value.length < 3) {
        showErrorMessage(nom, "Le nom doit contenir au moins 3 caractères.");
        isValid = false;
    } else {
        showSuccessMessage(nom, "nom valide.");
    }

    let regexPrenom = /^[a-zA-Z\s]{3,}$/;
    if (!regexPrenom.test(prenom.value)) {
        showErrorMessage(prenom, "La prenom doit contenir uniquement des lettres et des espaces, et au moins 3 caractères.");
        isValid = false;
    } else {
        showSuccessMessage(prenom, "prenom valide.");
    }

    let ns = new Date(naissance.value);
    let today = new Date();
    if (isNaN(ns.getTime()) || ns >= today) {
        showErrorMessage(naissance, "La date de naissance doit être inférieure à la date d'aujourd'hui.");
        isValid = false;
    } else {
        showSuccessMessage(naissance, "Date de naissance valide.");
    }

    if (isNaN(tel.value) || tel.value.length !== 8 || !/^\d+$/.test(tel.value)) {
        showErrorMessage(tel, "Le numéro de téléphone doit être composé de 8 chiffres.");
        isValid = false;
    } else {
        showSuccessMessage(tel, "Numéro de téléphone valide.");
    }

    let regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regexEmail.test(email.value)) {
        showErrorMessage(email, "L'adresse email doit contenir un @ et un point");
        isValid = false;
    } else {
        showSuccessMessage(email, "Adresse email valide.");
    }

    let regexMdp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;
    if (!regexMdp.test(mdp.value)) {
        showErrorMessage(mdp, "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre.");
        isValid = false;
    } else {
        showSuccessMessage(mdp, "Mot de passe valide.");
    }

    /*if (mdp.value !== confirmermdp.value) {
        showErrorMessage(confirmermdp, "Les mots de passe ne correspondent pas.");
        isValid = false;
    } else {
        showSuccessMessage(confirmermdp, "Mots de passe correspondent.");
    }*/

    if (!isValid) {
        event.preventDefault();
        console.log('Formulaire non soumis : erreurs détectées.');
        return false;
    }
        console.log('Formulaire soumis avec succès.');
});

function showErrorMessage(input, message) {
    const errorElement = document.createElement('p');
    errorElement.className = 'error-message';
    errorElement.style.color = 'red';
    errorElement.style.fontSize = '10px';
    errorElement.innerText = message;
    input.parentElement.appendChild(errorElement);
}

function showSuccessMessage(input, message) {
    const successElement = document.createElement('p');
    successElement.className = 'success-message';
    successElement.style.color = 'green';
    successElement.style.fontSize = '10px';
    successElement.innerText = message;
    input.parentElement.appendChild(successElement);
}

function clearMessages() {
    const messages = document.querySelectorAll('.error-message, .success-message');
    messages.forEach(message => message.remove());
}