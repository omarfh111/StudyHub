document.addEventListener("DOMContentLoaded", function () {
  // Récupérer les éléments du formulaire avec les IDs correspondants
  const emailInput = document.getElementById("eaddress");
  const telInput = document.getElementById("tel");
  const fnameInput = document.getElementById("fname");
  const lnameInput = document.getElementById("lname");
  const messageInput = document.getElementById("message");
  const submitButton = document.querySelector("input[type='submit']");
  
  // Fonction de validation d'email
  function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }
  
  // Fonction de validation du téléphone
  function validateTel(tel) {
    const telRegex = /^[0-9]{8,12}$/; // Adapte cette expression régulière selon les exigences pour le téléphone
    return telRegex.test(tel);
  }
  
  // Fonction pour vérifier si tous les champs sont vides
  function areFieldsEmpty() {
    return !fnameInput.value && !lnameInput.value && !emailInput.value && !telInput.value && !messageInput.value;
  }
  
  // Gestionnaire de soumission du formulaire
  submitButton.addEventListener("click", function (event) {
    let isValid = true;

    // Vérifier si tous les champs sont vides
    if (areFieldsEmpty()) {
      isValid = false;
      alert("Veuillez remplir les champs avant de soumettre.");
    }
    else {
      // Si tous les champs ne sont pas vides, procéder à la validation des champs spécifiques
      // Validation de l'email
      if (emailInput.value && !validateEmail(emailInput.value)) {
        isValid = false;
        alert("Veuillez entrer un email valide.");
      }
    
      // Validation du numéro de téléphone
      if (telInput.value && !validateTel(telInput.value)) {
        isValid = false;
        alert("Veuillez entrer un numéro de téléphone valide (8 à 12 chiffres).");
      }
    }
  
    // Empêcher la soumission si les champs ne sont pas valides
    if (!isValid) {
      event.preventDefault();
    }
  });
});
