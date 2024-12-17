<?php
require_once 'C:\xampp\htdocs\login6\Controller\ReponseController.php';

// Vérifier que $reponseController existe
if (!isset($reponseController)) {
    $reponseController = new ReponseController($db); // Initialiser le contrôleur si non défini
}

$id_evaluation = $_POST['id_evaluation'] ?? null;
$id_etudiant = $_POST['id_etudiant'] ?? 1; // Utilisateur statique
$reponses = $_POST['reponses'] ?? [];

if ($id_evaluation && !empty($reponses)) {
    // Formater les réponses pour l'enregistrement
    $formattedReponses = [];
    foreach ($reponses as $index => $reponse) {
        $formattedReponses[] = [
            'id_question' => $index + 1,
            'reponse_etudiant' => $reponse
        ];
    }

    // Enregistrer les réponses dans la base de données
    $reponseController->createReponse($id_evaluation, $id_etudiant, $formattedReponses);

    echo '<h2>Rendu soumis avec succès !</h2>';
} else {
    echo '<h2>Erreur : Données invalides.</h2>';
}
?>
