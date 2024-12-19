<?php
require_once 'C:\xampp\htdocs\login6\Controller\ReponseController.php';

if (!isset($db)) {
    require_once 'C:\xampp\htdocs\login6\config.php';
}
session_start();
if (isset($_COOKIE['studyhub'])) {
    // Décoder les données du cookie
    $userData = json_decode($_COOKIE['studyhub'], true);

    $email = $userData['email'];
    $nom = $userData['nom'];
    $role = $userData['role'];
} else {
    header('Location: /login6/view/login.php');
    exit();
}

// Instancier le contrôleur
$reponseController = new ReponseController($db);

// Récupérer les données du formulaire
$id_evaluation = $_POST['id_evaluation'] ?? null;
$id_etudiant = $_SESSION['user_id']; // Utilisateur statique
$reponses = $_POST['reponses'] ?? [];

if ($id_evaluation && !empty($reponses)) {
    // Formater les réponses
    $formattedReponses = [];
    foreach ($reponses as $id_question => $reponse) {
        $formattedReponses[] = [
            'id_question' => $id_question,
            'reponse_etudiant' => $reponse
        ];
    }

    // Appel au contrôleur pour enregistrer
    $reponseController->createReponse($id_evaluation, $id_etudiant, $formattedReponses);
    header('Location:liste_evaluations.php');
    exit();
    //echo "<p>Réponses enregistrées avec succès !</p>";
} else {
    //echo "<p>Erreur : Veuillez remplir toutes les réponses.</p>";
}
?>
