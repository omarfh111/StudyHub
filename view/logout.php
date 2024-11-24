<?php
session_start();
session_unset(); // Supprime toutes les variables de session
session_destroy(); // Détruit la session
setcookie('studyhub', '', time() - 3600, "/"); // Supprime le cookie
header('Location: login.php'); // Redirige vers la page de connexion
exit();
?>
