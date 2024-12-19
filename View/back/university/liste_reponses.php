<?php
// Récupérer toutes les réponses
$reponses = $reponseController->getAllReponses();

echo '<h2>Liste des Réponses</h2>';
if (!empty($reponses)) {
    echo '<table class="table table-striped">';
    echo '<thead>
            <tr>
                <th>ID Réponse</th>
                <th>ID Évaluation</th>
                <th>ID Étudiant</th>
                <th>Réponses</th>
                <th>Note</th>
                <th>Feedback</th>
                <th>Actions</th>
            </tr>
          </thead>';
    echo '<tbody>';
    foreach ($reponses as $reponse) {
        // Décoder les réponses JSON
        $reponsesDecodees = json_decode($reponse['reponses'], true);
        $reponseTexte = '';

        // Vérifier si $reponsesDecodees est un tableau
        if (is_array($reponsesDecodees)) {
            foreach ($reponsesDecodees as $rep) {
                $reponseTexte .= 'Question ' . htmlspecialchars($rep['id_question']) . ' : ' . htmlspecialchars($rep['reponse_etudiant']) . '<br>';
            }
        } else {
            $reponseTexte = 'JSON invalide ou aucune réponse disponible.';
        }

        // Affichage des données
        echo '<tr>';
        echo '<td>' . htmlspecialchars($reponse['id_reponse']) . '</td>';
        echo '<td>' . htmlspecialchars($reponse['id_evaluation']) . '</td>';
        echo '<td>' . htmlspecialchars($reponse['id_etudiant']) . '</td>';
        echo '<td>' . $reponseTexte . '</td>'; // Afficher les réponses décodées
        echo '<td>' . htmlspecialchars($reponse['note']) . '</td>';
        echo '<td>' . htmlspecialchars($reponse['feedback']) . '</td>';
        echo '<td>
                <a href="evaluation.php?action=correctReponse&id=' . $reponse['id_reponse'] . '" class="btn btn-warning btn-sm">Corriger</a>
                <a href="evaluation.php?action=deleteReponse&id=' . $reponse['id_reponse'] . '" class="btn btn-danger btn-sm">Supprimer</a>
              </td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>Aucune réponse trouvée.</p>';
}
?>
