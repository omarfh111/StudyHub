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

  // Fonction pour vérifier si la date est valide
  function validateDate(date) {
    return date && !isNaN(new Date(date).getTime()); // Vérifie si la date est non vide et valide
  }

  // Fonction pour vérifier si le nom ou prénom sont valides
  function validateName(name) {
    const nameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]{2,30}$/; // Lettres uniquement, avec accents, espaces, et longueurs entre 2 et 30
    return nameRegex.test(name);
  }

  // Fonction pour vérifier si tous les champs sont vides
  function areFieldsEmpty() {
    return !fnameInput.value && !lnameInput.value && !emailInput.value && !messageInput.value && !dateInput.value;
  }

  // Gestionnaire de soumission du formulaire
  submitButton.addEventListener("click", function (event) {
    let isValid = true;
    let errorMessage = '';

    // Vérifier si le prénom est vide
    if (!lnameInput.value) {
      isValid = false;
      errorMessage = "Veuillez entrer votre prénom.";
      alert(errorMessage); // Affiche le message d'erreur pour le prénom vide
      return; // Si prénom vide, on arrête l'exécution et on ne continue pas
    }

    // Vérifier si le nom est vide
    if (!fnameInput.value) {
      isValid = false;
      errorMessage = "Veuillez entrer votre nom.";
      alert(errorMessage); // Affiche le message d'erreur pour le nom vide
      return; // Si nom vide, on arrête l'exécution et on ne continue pas
    }

    // Validation de l'email
    if (!emailInput.value) {
      isValid = false;
      errorMessage = "Veuillez entrer votre email.";
      alert(errorMessage); // Affiche le message d'erreur pour l'email vide
      return; // Si email vide, on arrête l'exécution et on ne continue pas
    } else if (!validateEmail(emailInput.value)) {
      isValid = false;
      errorMessage = "Veuillez entrer un email valide.";
      alert(errorMessage); // Affiche le message d'erreur si l'email est invalide
      return; // Si email invalide, on arrête l'exécution et on ne continue pas
    }

    // Validation de la date
    if (!dateInput.value) {
      isValid = false;
      errorMessage = "Veuillez entrer une date.";
      alert(errorMessage); // Affiche le message d'erreur pour la date vide
      return; // Si date vide, on arrête l'exécution et on ne continue pas
    } else if (!validateDate(dateInput.value)) {
      isValid = false;
      errorMessage = "Veuillez entrer une date valide.";
      alert(errorMessage); // Affiche le message d'erreur si la date est invalide
      return; // Si date invalide, on arrête l'exécution et on ne continue pas
    }

    // Validation du message
    if (!messageInput.value) {
      isValid = false;
      errorMessage = "Veuillez écrire un message.";
      alert(errorMessage); // Affiche le message d'erreur pour le message vide
      return; // Si message vide, on arrête l'exécution et on ne continue pas
    }

    // Vérifier si tous les champs sont vides
    if (areFieldsEmpty()) {
      isValid = false;
      errorMessage = "Veuillez remplir tous les champs avant de soumettre.";
      alert(errorMessage); // Affiche le message d'erreur pour tous les champs vides
    }

    // Empêcher la soumission si les champs ne sont pas valides
    if (!isValid) {
      event.preventDefault();
    }
  });
});
