<?php

require_once 'C:/xampp/htdocs/login6/Controller/reponseC.php';

$pdo = config::getConnexion();

// Crée une instance de la classe ReponseC
$reponseC = new ReponseC();

if (isset($_GET['id_rsp']) && is_numeric($_GET['id_rsp'])) {
    $id_rsp = intval($_GET['id_rsp']);
    
    // Appeler la méthode pour supprimer la réponse
    $reponseC->supprimerReponse($id_rsp);  
    
    // Ajouter un paramètre de succès dans l'URL pour afficher un message de confirmation
    header('Location: view-reponse.php?message=success');  
    exit;
} else {
    echo "ID Réclamation non spécifié.";
    exit;
}

?>

