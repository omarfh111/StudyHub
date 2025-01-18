<?php
require_once 'C:\xampp\htdocs\login6\Controller\EvaluationController.php';  
// Récupérer toutes les évaluations
$evaluations = $evaluationController->getAllEvaluations();

echo '<h2>Liste des Évaluations</h2>';
if (!empty($evaluations)) {
    echo '<table class="table table-striped">';
    echo '<thead>
            <tr>
                <th>ID Évaluation</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
          </thead>';
    echo '<tbody>';
    foreach ($evaluations as $evaluation) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($evaluation['id_evaluation']) . '</td>';
        echo '<td>' . htmlspecialchars($evaluation['titre']) . '</td>';
        echo '<td>' . htmlspecialchars($evaluation['description']) . '</td>';
        echo '<td>
                <a href="evaluation.php?action=submitExercise&id_evaluation=' . $evaluation['id_evaluation'] . '" class="btn btn-primary btn-sm">Répondre</a>
              </td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>Aucune évaluation disponible.</p>';
}
?>
