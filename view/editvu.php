<?php
require_once '../controller/UserController.php';
$key='00';
function encryptPassword($password, $key) {
    $cipherMethod = 'AES-256-CBC';
    $ivLength = openssl_cipher_iv_length($cipherMethod);
    $iv = openssl_random_pseudo_bytes($ivLength);
    $encryptedPassword = openssl_encrypt($password, $cipherMethod, $key, 0, $iv);
    return base64_encode($iv . $encryptedPassword);
}
function decryptPassword($encryptedPassword, $key) {

    $cipherMethod = 'AES-256-CBC';

    // Decode the base64 encoded string
    $data = base64_decode($encryptedPassword);

    // Extract the initialization vector and encrypted password
    $ivLength = openssl_cipher_iv_length($cipherMethod);
    $iv = substr($data, 0, $ivLength);
    $encryptedPassword = substr($data, $ivLength);

    // Decrypt the password
    $decryptedPassword = openssl_decrypt($encryptedPassword, $cipherMethod, $key, 0, $iv);

    return $decryptedPassword;
}
// Vérifiez si un ID d'utilisateur est passé dans l'URL
if (!isset($_GET['idu']) || empty($_GET['idu'])) {
    die("ID utilisateur manquant.");
}

$userC = new UserController();
$id = $_GET['idu'];

// Récupérez les données de l'utilisateur à partir de la liste
$liste = $userC->listuser();
$user = null;
foreach ($liste as $u) {
    if ($u['idu'] == $id) {
        $user = $u;
        break;
    }
}

if (!$user) {
    die("Utilisateur introuvable.");
}

// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Créez un nouvel objet User avec les données soumises
    $updatedUser = new User(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['email'],
        new DateTime($_POST['naissance']),
        $_POST['tel'],
        encryptPassword($_POST['mdp'], $key), // Gardez l'ancien mot de passe s'il n'est pas modifié
        $user['metier'],
        $_POST['role']
    );

    // Mettez à jour l'utilisateur
    $userC->updateuser($updatedUser, $id);

    // Redirection vers la liste après la mise à jour
    header('Location: profile.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1>Modifier l'utilisateur</h1>

<form method="POST">
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($user['nom']); ?>" required>

    <label for="prenom">Prénom</label>
    <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($user['prenom']); ?>" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>

    <label for="naissance">Date de naissance</label>
    <input type="date" id="naissance" name="naissance" value="<?= htmlspecialchars($user['naissance']); ?>" required>

    <label for="tel">Téléphone</label>
    <input type="text" id="tel" name="tel" value="<?= htmlspecialchars($user['tel']); ?>" required>

    <label for="new_password">Nouveau mot de passe</label>
    <input type="password" id="mdp" name="mdp"  value="<?= htmlspecialchars(decryptPassword($user['mdp'], $key)); ?>" placeholder="Laissez vide pour conserver l'ancien mot de passe">

    <label for="role">Rôle</label>
    <input type="text" id="role" name="role" value="<?= htmlspecialchars($user['rol']); ?>" readonly>

    <button type="submit">Mettre à jour</button>
</form>

</body>
</html>
