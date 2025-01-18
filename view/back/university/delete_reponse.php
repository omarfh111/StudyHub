<?php
$id = $_GET['id'] ?? null;

if ($id) {
    $success = $reponseController->deleteReponse($id);

    if ($success) {
        echo '<p>Réponse supprimée avec succès.</p>';
    } else {
        echo '<p>Erreur : Impossible de supprimer la réponse.</p>';
    }
    echo '<a href="evaluation.php?action=listeReponses" class="btn btn-primary">Retour à la liste</a>';
}
?>
