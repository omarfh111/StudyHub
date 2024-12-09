document.addEventListener("DOMContentLoaded", function () {
  // Récupérer les éléments du formulaire avec les IDs correspondants
  const emailInput = document.getElementById("eaddress");
  const fnameInput = document.getElementById("fname");
  const lnameInput = document.getElementById("lname");
  const messageInput = document.getElementById("message");
  const dateInput = document.getElementById("date"); // Champ date
  const submitButton = document.querySelector("input[type='submit']");
  
  // Fonction de validation d'email
  function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  // Fonction de validation de la date
  function validateDate(date) {
    return date && !isNaN(new Date(date).getTime()); // Vérifie si la date est non vide et valide
  }

  // Fonction de validation du nom
  function validateName(name) {
    const nameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]{2,30}$/; // Lettres uniquement, avec accents, espaces, et longueurs entre 2 et 30
    return nameRegex.test(name);
  }

  // Vérifier si un champ est vide et afficher le message d'erreur
  function showError(input, message) {
    const errorElement = input.nextElementSibling; // Trouver le <small> associé à l'input
    errorElement.textContent = message;
    errorElement.style.display = "block"; // Affiche l'erreur
  }

  // Cacher les messages d'erreur
  function clearError(input) {
    const errorElement = input.nextElementSibling;
    errorElement.textContent = "";
    errorElement.style.display = "none";
  }

  // Fonction de validation générale
  submitButton.addEventListener("click", function (event) {
    let isValid = true;

    // Vérifier le prénom
    if (!lnameInput.value) {
      showError(lnameInput, "* Veuillez entrer votre prénom.");
      isValid = false;
    } else {
      clearError(lnameInput);
    }

    // Vérifier le nom
    if (!fnameInput.value) {
      showError(fnameInput, "* Veuillez entrer votre nom.");
      isValid = false;
    } else {
      clearError(fnameInput);
    }

    // Vérifier l'email
    if (!emailInput.value) {
      showError(emailInput, "* Veuillez entrer votre email.");
      isValid = false;
    } else if (!validateEmail(emailInput.value)) {
      showError(emailInput, "Veuillez entrer un email valide.");
      isValid = false;
    } else {
      clearError(emailInput);
    }

    // Vérifier la date
    if (!dateInput.value) {
      showError(dateInput, "* Veuillez entrer une date.");
      isValid = false;
    } else if (!validateDate(dateInput.value)) {
      showError(dateInput, "* Veuillez entrer une date valide.");
      isValid = false;
    } else {
      clearError(dateInput);
    }

    // Vérifier le message
    if (!messageInput.value) {
      showError(messageInput, "* Veuillez écrire un message.");
      isValid = false;
    } else {
      clearError(messageInput);
    }

    // Si tout est valide, soumettre le formulaire, sinon empêcher l'envoi
    if (!isValid) {
      event.preventDefault(); // Empêche l'envoi du formulaire si un champ est vide
    }
  });
});
