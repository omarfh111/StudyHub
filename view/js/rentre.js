function updateSelectedOffers() {
    const checkboxes = document.querySelectorAll('input[name="offers[]"]:checked');
    const offerMessage = document.getElementById('offer-message');

    if (checkboxes.length > 0) {
        let selectedOffers = Array.from(checkboxes).map(checkbox => checkbox.value).join(', ');
        offerMessage.textContent = `Offres sélectionnées : ${selectedOffers}`;
        offerMessage.style.color = '#2b6cb0'; // Default color
    } else {
        offerMessage.textContent = 'Choisir une offre';
        offerMessage.style.color = 'red';
    }
}

function validateSelection() {
    const checkboxes = document.querySelectorAll('input[name="offers[]"]:checked');
    if (checkboxes.length === 0) {
        alert("Veuillez sélectionner au moins une offre.");
        return false; // Prevent form submission
    }
    return true; // Proceed with form submission
}