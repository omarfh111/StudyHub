<?php
require_once '../controller/UserController.php';
error_reporting(E_ALL & ~E_WARNING);
$userC = new UserController();
$liste = $userC->listuser();
$key='00';
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .actions a {
            text-decoration: none;
            padding: 8px 12px;
            color: white;
            background-color: #007BFF;
            border-radius: 5px;
            font-size: 14px;
        }
        .actions a:hover {
            background-color: #0056b3;
        }
        .delete {
            background-color: #FF6347;
        }
        .delete:hover {
            background-color: #cc5040;
        }
    </style>
</head>
<body>

<h1>Liste des utilisateurs</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Date de naissance</th>
        <th>Téléphone</th>
        <th>Mot de passe</th>
        <th>Métier</th>
        <th>Rôle</th>
        <th colspan="2">Actions</th>
    </tr>
    <?php
        foreach ($liste as $user) {
            $decryptedPassword = decryptPassword($user['mdp'], $key);
    ?> 
    <tr>
        <td><?= $user['idu']; ?></td>
        <td><?= $user['nom']; ?></td>
        <td><?= $user['prenom']; ?></td>
        <td><?= $user['email']; ?></td>
        <td><?= $user['naissance']; ?></td>
        <td><?= $user['tel']; ?></td>
        <td><?= $decryptedPassword; ?></td>
        <td><?= $user['rol']; ?></td>
        <td class="actions">
            <a href="edit.php?idu=<?= $user['idu']; ?>">Modifier</a>
            <a href="deluser.php?idu=<?php echo $user['idu']; ?>">Delete</a>
        </td>
    </tr>
    <?php
        }
    ?>
</table>

</body>
</html>
