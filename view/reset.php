<?php
require_once '../config.php';  // Fichier de configuration de la base de données
require_once '../model/user.php'; // Fichier pour accéder aux données de l'utilisateur
require_once '../controller/UserController.php'; // Adjust the path if necessary
$key='00';
function encryptPassword($password, $key) {
    $cipherMethod = 'AES-256-CBC';
    $ivLength = openssl_cipher_iv_length($cipherMethod);
    $iv = openssl_random_pseudo_bytes($ivLength);
    $encryptedPassword = openssl_encrypt($password, $cipherMethod, $key, 0, $iv);
    return base64_encode($iv . $encryptedPassword);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les informations du formulaire
    $code = $_POST["code"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Vérifier si les mots de passe correspondent
    if ($new_password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
        exit();
    }

    try {
        $pdo = config::getConnexion();

        // Vérifier si le code existe dans la base de données
        $stmt = $pdo->prepare("SELECT * FROM user WHERE code = ?");
        $stmt->execute([$code]);
        $user = $stmt->fetch();

        if ($user) {
            // Le code est valide, mettre à jour le mot de passe
            $hashed_password = encryptPassword($new_password, $key);  // Hash du mot de passe pour la sécurité
            $stmt = $pdo->prepare("UPDATE user SET mdp = ?, code = NULL WHERE code = ?");
            $stmt->execute([$hashed_password, $code]);

            echo "Votre mot de passe a été mis à jour avec succès.";
        } else {
            echo "Code de réinitialisation invalide.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer le mot de passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 50px;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
        }
        .form-container h2 {
            text-align: center;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Réinitialiser votre mot de passe</h2>
        <form method="POST" action="reset.php">
            <label for="code">Code de réinitialisation :</label>
            <input type="text" id="code" name="code" required>

            <label for="new_password">Nouveau mot de passe :</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="confirm_password">Confirmer le mot de passe :</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit">Changer le mot de passe</button>
        </form>
    </div>

</body>
</html>
