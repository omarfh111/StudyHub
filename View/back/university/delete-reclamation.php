<?php
require_once 'C:/xampp/htdocs/WebProject/config.php';
require_once 'C:/xampp/htdocs/WebProject/Controller/reclamationC.php'; 


// Vérifier si l'ID de la réclamation est passé via GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sécuriser l'ID

    // Appeler la méthode du contrôleur pour supprimer la réclamation
    $controller = new ReclamationController();
    $controller->supprimerReclamation($id);
    header("Location: /WebProject/View/back/university/app-contact.php?message=success_delete");

} else {
    echo "Erreur : ID invalide.";
    header("Location: /WebProject/View/back/university/app-contact.php?message=success");
}
    



    /*Rediriger vers la page des réclamations avec un message de succès
header("Location: /WebProject/View/back/university/app-contact.php?message=success_delete");

    exit();
} else {
    // Si l'ID n'est pas passé ou il y a un problème, rediriger vers la page d'origine avec un message d'erreur
header("Location: /WebProject/View/back/university/app-contact.php?message=success");

    exit();
} */


