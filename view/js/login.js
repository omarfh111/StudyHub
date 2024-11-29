document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        loginAdmin();
    }
});
function loginAdmin() {
    const user = document.getElementById('user').value; // Get the value of the username input
    const password = document.getElementById('password').value; // Get the value of the password input

    if (user === "admin" && password === "admin") {
        window.location.href = "ajoutoffre.html"; // Redirect to ajoutoffre.html
    } else {
        alert("Nom d'utilisateur ou mot de passe incorrect."); // Show error message
    }
}
