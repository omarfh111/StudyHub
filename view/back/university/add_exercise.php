<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Exercice</title>
</head>
<body>
    <h1>Ajouter un Exercice</h1>
    <form action="evaluation.php?action=createExercise" method="post" id="exerciseForm">
        <label for="titre">Titre de l'exercice :</label><br>
        <input type="text" name="titre" id="titre" required><br><br>

        <label for="description">Description :</label><br>
        <textarea name="description" id="description" required></textarea><br><br>

        <h3>Questions :</h3>
        <div id="questionsContainer">
            <div class="question">
                <label>Question 1 :</label>
                <input type="text" name="questions[]" placeholder="Entrez votre question ici" required><br><br>
            </div>
        </div>
        <button type="button" onclick="addQuestion()">Ajouter une autre question</button><br><br>

        <input type="hidden" name="questions_json" id="questions_json">
        <button type="submit">Ajouter l'exercice</button>
    </form>

    <script>
        let questionCount = 1;

        // Fonction pour ajouter une nouvelle question
        function addQuestion() {
            questionCount++;
            const container = document.getElementById('questionsContainer');
            const newQuestion = document.createElement('div');
            newQuestion.classList.add('question');
            newQuestion.innerHTML = `
                <label>Question ${questionCount} :</label>
                <input type="text" name="questions[]" placeholder="Entrez votre question ici" required><br><br>
            `;
            container.appendChild(newQuestion);
        }

        // Avant de soumettre le formulaire, convertir les questions en JSON
        document.getElementById('exerciseForm').addEventListener('submit', function (e) {
            const questionInputs = document.getElementsByName('questions[]');
            const questions = [];
            questionInputs.forEach((input, index) => {
                questions.push({
                    id_question: index + 1,
                    contenu: input.value
                });
            });
            document.getElementById('questions_json').value = JSON.stringify(questions);
        });
    </script>
</body>
</html>
