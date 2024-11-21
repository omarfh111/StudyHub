<?php
require_once '../controller/UserController.php';

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
        $user['mdp'], // Gardez l'ancien mot de passe s'il n'est pas modifié
        $_POST['metier'],
        $_POST['role']
    );

    // Mettez à jour l'utilisateur
    $userC->updateuser($updatedUser, $id);

    // Redirection vers la liste après la mise à jour
    header('Location: http://localhost/login6/view/back/university/students.php');
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

    <label for="metier">Métier</label>
    <input type="text" id="metier" name="metier" value="<?= htmlspecialchars($user['metier']); ?>" required>

    <label for="new_password">Nouveau mot de passe</label>
    <input type="password" id="mdp" name="mdp"  value="<?= htmlspecialchars($user['mdp']); ?>" placeholder="Laissez vide pour conserver l'ancien mot de passe">

    <label for="role">Rôle</label>
    <select id="role" name="role" required>
        <option value="admin" <?= $user['rol'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
        <option value="prof" <?= $user['rol'] === 'prof' ? 'selected' : ''; ?>>Prof</option>
        <option value="etudiant" <?= $user['rol'] === 'etudiant' ? 'selected' : ''; ?>>Etudiant</option>
    </select>

    <button type="submit">Mettre à jour</button>
</form>

</body>
</html>
