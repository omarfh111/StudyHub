<?php
$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'] ?? '';
    $description = $_POST['description'] ?? '';
    $questions = $_POST['questions'] ?? []; // Récupérer les questions comme un tableau

    // Valider que les questions sont un tableau non vide
    if ($id && $titre && $description && is_array($questions)) {
        $success = $evaluationController->updateEvaluation($id, $titre, $description, $questions);

        if ($success) {
            echo '<p>L\'évaluation a été mise à jour avec succès.</p>';
        } else {
            echo '<p>Erreur : Impossible de mettre à jour l\'évaluation.</p>';
        }
        echo '<a href="evaluation.php?action=listeEvaluations" class="btn btn-primary">Retour à la liste</a>';
    } else {
        echo '<p>Erreur : Veuillez remplir tous les champs correctement.</p>';
    }
} else {
    $evaluation = $evaluationController->getEvaluationById($id);

    if ($evaluation) {
        $questions = json_decode($evaluation['questions'], true); // Décoder les questions
        ?>
        <h2>Modifier une Évaluation</h2>
        <form method="post" action="">
            <label for="titre">Titre :</label><br>
            <input type="text" name="titre" id="titre" value="<?= htmlspecialchars($evaluation['titre']) ?>" required><br><br>
            <label for="description">Description :</label><br>
            <textarea name="description" id="description" required><?= htmlspecialchars($evaluation['description']) ?></textarea><br><br>

            <h3>Questions</h3>
            <div id="questions-container">
                <?php
                if (is_array($questions) && !empty($questions)) {
                    foreach ($questions as $index => $question) {
                        $contenu = $question['contenu'] ?? ''; // Assurez-vous que 'contenu' existe
                        echo '<div>';
                        echo '<label>Question ' . ($index + 1) . ' :</label><br>';
                        echo '<input type="text" name="questions[' . $index . '][contenu]" value="' . htmlspecialchars($contenu) . '" required><br><br>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Aucune question disponible. Ajoutez-en une ci-dessous.</p>';
                }
                ?>
            </div>
            <button type="button" onclick="addQuestion()">Ajouter une question</button><br><br>

            <button type="submit" class="btn btn-warning">Mettre à jour</button>
        </form>

        <script>
function addQuestion() {
    const container = document.getElementById('questions-container');
    const index = container.children.length;
    const div = document.createElement('div');
    div.innerHTML = `
        <label>Question ${index + 1} :</label><br>
        <input type="text" name="questions[${index}][contenu]" placeholder="Entrez votre question ici" required><br><br>
    `;
    container.appendChild(div);
}
        </script>
        <?php
    } else {
        echo '<p>Erreur : Évaluation introuvable.</p>';
    }
}
?>
