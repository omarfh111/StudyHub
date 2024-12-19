<?php
$id_evaluation = $_GET['id_evaluation'] ?? null;

if (!$id_evaluation) {
    die('<p>Erreur : Aucun ID d\'évaluation fourni.</p>');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $id_etudiant = $_POST['id_etudiant'] ?? 1; // ID utilisateur statique
    $reponses = $_POST['reponses'] ?? [];

    if (!empty($reponses)) {
        // Formater les réponses pour l'enregistrement
        $formattedReponses = [];
        foreach ($reponses as $id_question => $reponse) {
            $formattedReponses[] = [
                'id_question' => $id_question,
                'reponse_etudiant' => $reponse
            ];
        }

        // Enregistrer les réponses via le contrôleur
        $success = $reponseController->createReponse($id_evaluation, $id_etudiant, $formattedReponses);

        if ($success) {
            echo '<div class="alert alert-success">Réponses soumises avec succès.</div>';
        } else {
            echo '<div class="alert alert-danger">Erreur : Impossible de soumettre les réponses.</div>';
        }
        echo '<a href="evaluation.php?action=listeEvaluations" class="btn btn-primary">Retour à la liste</a>';
        exit;
    } else {
        echo '<div class="alert alert-warning">Erreur : Veuillez remplir toutes les réponses.</div>';
    }
} else {
    // Afficher les questions de l'évaluation
    $evaluation = $evaluationController->getEvaluationById($id_evaluation);

    if ($evaluation) {
        $questions = json_decode($evaluation['questions'], true);

        // Vérification de la validité du JSON
        if (!is_array($questions)) {
            echo '<p>Erreur : Les questions sont mal formatées.</p>';
            exit;
        }
        ?>

        <h2>Répondre à l'évaluation : <?= htmlspecialchars($evaluation['titre']) ?></h2>
        <form method="post" action="">
            <input type="hidden" name="id_evaluation" value="<?= htmlspecialchars($id_evaluation) ?>">
            <input type="hidden" name="id_etudiant" value="1"> <!-- Utilisateur statique -->

            <?php
            $id_auto = 1; // Compteur automatique pour les questions sans ID
            foreach ($questions as $question) {
                $id_question = $question['id_question'] ?? $id_auto++;
                $contenu = $question['contenu'] ?? 'Question sans contenu';

                echo '<div class="form-group">';
                echo '<label>Question ' . htmlspecialchars($id_question) . ' : ' . htmlspecialchars($contenu) . '</label>';
                echo '<textarea class="form-control" name="reponses[' . htmlspecialchars($id_question) . ']" rows="3" required></textarea>';
                echo '</div>';
            }
            ?>

            <button type="submit" class="btn btn-primary">Soumettre</button>
        </form>
        <?php
    } else {
        echo '<div class="alert alert-danger">Erreur : Évaluation introuvable.</div>';
    }
}
?>
