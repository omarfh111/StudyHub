<?php
$titre = $_POST['titre'] ?? '';
$description = $_POST['description'] ?? '';
$questions_json = $_POST['questions_json'] ?? '[]';
$questions = json_decode($questions_json, true);

if ($titre && $description && is_array($questions)) {
    $evaluationController->createEvaluation($titre, $description, $questions);
    echo '<p>Exercice ajouté avec succès !</p>';
} else {
    echo '<p>Erreur : Remplissez tous les champs correctement.</p>';
}
?>
