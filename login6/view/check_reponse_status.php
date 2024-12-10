<?php
require_once 'C:/xampp/htdocs/login6/Controller/reclamationC.php';  

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Inclure le contrôleur de réclamation
    require_once 'C:\xampp\htdocs\login6\config.php';
    require_once 'C:\xampp\htdocs\login6\Model\reclamationM.php';

    // Créer une instance de ReclamationController
    $controller = new ReclamationController();
    
    // Vérifier si une réponse existe pour la réclamation
    $reponseExist = $controller->getReponseByReclamationId($id);

    // Retourner 'true' ou 'false' en fonction de la réponse
    echo $reponseExist ? 'true' : 'false';
}


?>
<style>
.notification {
    background-color: #51be78;
    color: white;
    padding: 15px;
    position: fixed;
    top: 20px;
    right: 20px;
    border-radius: 8px;
    display: none;
    z-index: 9999;
}
</style>


