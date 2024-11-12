document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM entièrement chargé et analysé"); // Vérification de chargement du DOM

    const emailInput = document.getElementById("eaddress");
    const telInput = document.getElementById("tel");
    const submitButton = document.querySelector("input[type='submit']");

    if (!emailInput || !telInput || !submitButton) {
        console.log("Échec de la récupération d'un ou plusieurs éléments");
        return; // Sortir si un élément n'est pas trouvé
    }

    // Fonction de validation d'email
    function validateEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }

    // Fonction de validation du téléphone
    function validateTel(tel) {
      const telRegex = /^[0-9]{8,12}$/;
      return telRegex.test(tel);
    }

    // Gestionnaire de soumission du formulaire
    submitButton.addEventListener("click", function (event) {
      let isValid = true;

      // Validation de l'email
      if (!validateEmail(emailInput.value)) {
        isValid = false;
        alert("Veuillez entrer un email valide.");
        console.log("Email invalide détecté : " + emailInput.value);
      }

      // Validation du numéro de téléphone
      if (!validateTel(telInput.value)) {
        isValid = false;
        alert("Veuillez entrer un numéro de téléphone valide (8 à 12 chiffres).");
        console.log("Numéro de téléphone invalide détecté : " + telInput.value);
      }

      // Empêcher la soumission si les champs ne sont pas valides
      if (!isValid) {
        event.preventDefault();
        console.log("Envoi du formulaire empêché en raison de données non valides");
      } else {
        console.log("Formulaire valide, envoi en cours...");
      }
    });
});

  