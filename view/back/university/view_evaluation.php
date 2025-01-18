<?php
$id = $_GET['id'] ?? null;

if ($id) {
    $evaluation = $evaluationController->getEvaluationById($id);

    if ($evaluation) {
        // Décoder les questions en tableau
        $questions = json_decode($evaluation['questions'], true);

        echo '<h2>Détails de l\'évaluation</h2>';
        echo '<p><strong>ID :</strong> ' . htmlspecialchars($evaluation['id_evaluation']) . '</p>';
        echo '<p><strong>Titre :</strong> ' . htmlspecialchars($evaluation['titre']) . '</p>';
        echo '<p><strong>Description :</strong> ' . htmlspecialchars($evaluation['description']) . '</p>';

        // Vérifier que $questions est un tableau valide
        if (is_array($questions) && !empty($questions)) {
            echo '<h3>Questions</h3>';
            echo '<ul>';
            foreach ($questions as $index => $question) {
                echo '<li><strong>Question ' . ($index + 1) . ' :</strong> ' . htmlspecialchars($question['contenu']) . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>Aucune question trouvée pour cette évaluation.</p>';
        }

        echo '<a href="evaluation.php?action=listeEvaluations" class="btn btn-primary">Retour à la liste</a>';
    } else {
        echo '<p>Erreur : Évaluation introuvable.</p>';
    }
}
?>
