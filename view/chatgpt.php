<?php
require_once '../config.php';
session_start(); // Démarrer la session pour conserver l'historique
if (isset($_COOKIE['studyhub'])) {
    // Décoder les données du cookie
    $userData = json_decode($_COOKIE['studyhub'], true);
  
    $email = $userData['email'];
    $nom = $userData['nom'];
    $role = $userData['role'];
  } else {
    header('Location: login.php');
    exit();
  }
// Remplacez par votre clé API sécurisée
$apiKey ='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';
if (!$apiKey) {
    die('Error: API key not set.');
}

// Fonction pour interagir avec l'API OpenAI
function askChatGPT($messages) {
    global $apiKey;

    $url = 'https://api.openai.com/v1/chat/completions';
    $headers = [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json',
    ];
    $data = [
        'model' => 'gpt-3.5-turbo', // Modèle à utiliser
        'messages' => $messages,    // Historique des messages
        'max_tokens' => 300,        // Limite des tokens pour chaque réponse
        'temperature' => 0.7,       // Contrôle de la créativité
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log("cURL Error: " . curl_error($ch));
        return 'Error: Unable to reach ChatGPT API.';
    }

    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $result = json_decode($response, true);

    if (!$result || $http_code !== 200) {
        return 'Error: Unable to process the request.';
    }

    return $result['choices'][0]['message']['content'] ?? 'No response from ChatGPT.';
}

// Initialiser l'historique si nécessaire
if (!isset($_SESSION['chat_history'])) {
    $_SESSION['chat_history'] = [
        ['role' => 'system', 'content' => 'You are a helpful assistant.']
    ];
}

// Si une nouvelle question est posée
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['question'])) {
    $userMessage = $_POST['question'];
    
    // Ajouter le message utilisateur à l'historique
    $_SESSION['chat_history'][] = ['role' => 'user', 'content' => $userMessage];

    // Envoyer la conversation complète à l'API
    $response = askChatGPT($_SESSION['chat_history']);

    // Ajouter la réponse de l'IA à l'historique
    $_SESSION['chat_history'][] = ['role' => 'assistant', 'content' => $response];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatGPT Conversation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .chat-container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .message {
            margin: 10px 0;
        }
        .message.user {
            text-align: right;
        }
        .message.assistant {
            text-align: left;
        }
        .message p {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 15px;
            margin: 0;
            max-width: 80%;
        }
        .message.user p {
            background-color: #dcf8c6;
            color: #333;
        }
        .message.assistant p {
            background-color: #f1f1f1;
            color: #555;
        }
        textarea {
            width: 100%;
            height: 80px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }

        /* Styles pour le bouton déconnexion */
        .logout-btn {
            background-color: #f44336;
            color: white;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
        .logout-btn:hover {
            background-color: #d32f2f;
        }

        /* Styles pour le bouton retour à index */
        .back-btn {
            background-color: #2196F3;
            color: white;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
        .back-btn:hover {
            background-color: #1976D2;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <h1>StudyHub AI Chat</h1>

        <!-- Affichage de l'utilisateur connecté -->
        <p>Welcome, <?php echo $nom . " (" . $role . ")"; ?>!</p>

        <!-- Boutons de déconnexion et retour à index -->
        <a href="logout.php" class="logout-btn">Logout</a>
        <a href="index.php" class="back-btn">Back to Home</a>

        <div class="chat-box" id="chatBox">
            <?php if (isset($_SESSION['chat_history'])): ?>
                <?php foreach ($_SESSION['chat_history'] as $message): ?>
                    <div class="message <?= htmlspecialchars($message['role']) ?>">
                        <p><?= nl2br(htmlspecialchars($message['content'])) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <form method="POST" action="">
            <textarea name="question" placeholder="Type your message..." required></textarea>
            <button type="submit">Send</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Fonction pour faire défiler vers le bas après l'envoi du message
        function scrollToBottom() {
            var chatBox = document.getElementById("chatBox");
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        // Fonction pour envoyer le message en AJAX sans recharger la page
        $('#chatForm').on('submit', function(event) {
            event.preventDefault(); // Empêcher la soumission du formulaire

            var message = $('textarea[name="question"]').val(); // Récupérer le message

            $.ajax({
                url: '', // L'URL de la page actuelle
                type: 'POST',
                data: { question: message }, // Envoyer la question
                success: function(response) {
                    // Lorsque le message est envoyé avec succès, rechargez l'affichage du chat
                    $('#chatBox').html(response); // Mettre à jour la zone de chat avec la réponse
                    scrollToBottom(); // Faire défiler vers le bas
                }
            });
        });

        // Faire défiler vers le bas au chargement de la page
        $(document).ready(function() {
            scrollToBottom();
        });
    </script>

</body>
</html>
