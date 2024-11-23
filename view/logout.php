<?php
session_start();
session_unset(); // Supprime toutes les variables de session
session_destroy(); // Détruit la session

// Supprime les cookies
setcookie('user_id', '', time() - 3600, "/");
setcookie('user_name', '', time() - 3600, "/");

header('Location: login.php');
exit();
?>
