<?php
$id = $_GET['id'] ?? null;

if ($id) {
    $success = $evaluationController->deleteEvaluation($id);
    if ($success) {
        echo '<p>L\'évaluation a été supprimée avec succès.</p>';
    } else {
        echo '<p>Erreur : Impossible de supprimer l\'évaluation.</p>';
    }
    echo '<a href="evaluation.php?action=listeEvaluations" class="btn btn-primary">Retour à la liste</a>';
}
?>
