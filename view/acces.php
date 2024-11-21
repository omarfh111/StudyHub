<?php
require_once '../config.php';
$key = '00';

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    try {
        $pdo = config::getConnexion();

        // Récupère l'utilisateur par email uniquement
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            // Déchiffre le mot de passe stocké
            $decryptedPassword = decryptPassword($user['mdp'], $key);

            // Compare les mots de passe
            if ($decryptedPassword === $mdp) {
                if ($user['rol'] === 'admin') {
                    header('Location: http://localhost/login6/view/back/university/students.php');
                    exit();
                } elseif (in_array($user['rol'], ['etudiant', 'prof'])) {
                    header('Location: index.php');
                    exit();
                }
            } else {
                header('Location: 500.php'); // Mauvais mot de passe
                exit();
            }
        }
    } catch (PDOException $e) {
        // Redirige vers une page d'erreur en cas de problème avec la base de données
        header('Location: error.php');
        exit();
    }
}
?>
