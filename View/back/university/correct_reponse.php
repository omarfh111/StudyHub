<?php
$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note = $_POST['note'] ?? null;
    $feedback = $_POST['feedback'] ?? '';

    if ($id && $note !== null) {
        // Récupérer les réponses existantes
        $reponseExistante = $reponseController->getReponseById($id);
        $reponsesExistantes = $reponseExistante['reponses'] ?? '[]';

        // Appel à la mise à jour en réutilisant les réponses existantes
        $success = $reponseController->updateReponse($id, $reponsesExistantes, $note, $feedback);

        if ($success) {
            echo '<p>Réponse corrigée avec succès.</p>';
        } else {
            echo '<p>Erreur : Impossible de corriger la réponse.</p>';
        }
        echo '<a href="evaluation.php?action=listeReponses" class="btn btn-primary">Retour à la liste</a>';
        exit;
    } else {
        echo '<p>Erreur : Tous les champs sont obligatoires.</p>';
    }
} else {
    $reponse = $reponseController->getReponseById($id);

    if ($reponse) {
        $questions = json_decode($reponse['questions'], true);
        $reponsesDecodees = json_decode($reponse['reponses'], true);
        ?>
        <h2>Corriger une Réponse</h2>
        <form method="post" action="">
            <h3>Questions et Réponses</h3>
            <div id="questions-container">
                <?php
                if (is_array($questions) && is_array($reponsesDecodees)) {
                    foreach ($questions as $index => $question) {
                        $id_question = $question['id_question'] ?? $index + 1;
                        $contenu = $question['contenu'] ?? 'Question indisponible';
                        $reponse_etudiant = 'Réponse non fournie';

                        foreach ($reponsesDecodees as $reponseItem) {
                            if ($reponseItem['id_question'] == $id_question) {
                                $reponse_etudiant = $reponseItem['reponse_etudiant'];
                                break;
                            }
                        }

                        echo '<div>';
                        echo '<label><strong>Question :</strong> ' . htmlspecialchars($contenu) . '</label><br>';
                        echo '<label><strong>Réponse :</strong> ' . htmlspecialchars($reponse_etudiant) . '</label><br><br>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Aucune question ou réponse trouvée.</p>';
                }
                ?>
            </div>

            <label for="note">Note :</label><br>
            <input type="number" step="0.01" name="note" id="note" value="<?= htmlspecialchars($reponse['note']) ?>" required><br><br>

            <label for="feedback">Feedback :</label><br>
            <textarea name="feedback" id="feedback" rows="4"><?= htmlspecialchars($reponse['feedback']) ?></textarea><br><br>

            <button type="submit" class="btn btn-warning">Mettre à jour</button>
        </form>
        <?php
    } else {
        echo '<p>Erreur : Réponse introuvable.</p>';
    }
}
?>
