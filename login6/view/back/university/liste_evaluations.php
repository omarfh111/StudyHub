<?php
// Récupérer le mot-clé de recherche
$searchKeyword = $_GET['search'] ?? '';

// Effectuer la recherche si un mot-clé est fourni
if (!empty($searchKeyword)) {
    $evaluations = $evaluationController->searchEvaluationsByTitle($searchKeyword);
} else {
    $evaluations = $evaluationController->getAllEvaluations();
}

echo '<h2>Liste des Évaluations</h2>';

// Formulaire de recherche
echo '<form method="get" action="" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher une évaluation par titre"
                   value="' . htmlspecialchars($searchKeyword) . '">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Rechercher</button>
            </div>
        </div>
      </form>';

if (!empty($evaluations)) {
    echo '<table class="table table-striped">';
    echo '<thead>
            <tr>
                <th>ID</th>
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
                <a href="evaluation.php?action=deleteEvaluation&id=' . $evaluation['id_evaluation'] . '" class="btn btn-danger btn-sm">Supprimer</a>
                <a href="evaluation.php?action=viewEvaluation&id=' . $evaluation['id_evaluation'] . '" class="btn btn-info btn-sm">Voir</a>
                <a href="evaluation.php?action=updateEvaluation&id=' . $evaluation['id_evaluation'] . '" class="btn btn-warning btn-sm">Modifier</a>
              </td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>Aucune évaluation trouvée.</p>';
}
?>
