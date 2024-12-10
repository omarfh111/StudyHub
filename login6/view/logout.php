<?php
session_start(); // Démarre la session

// Effacer l'historique du chat
unset($_SESSION['chat_history']);

// Supprime toutes les variables de session et détruit la session
session_unset(); 
session_destroy(); 

// Supprimer les cookies associés
setcookie('studyhub', '', time() - 3600, "/"); 

// Redirige vers la page de connexion
header('Location: login.php');
exit();
?>
