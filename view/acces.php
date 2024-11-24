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
$alert = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $remember = isset($_POST['remember']) ? true : false;
    try {
        $pdo = config::getConnexion();

        // Récupère l'utilisateur par email uniquement
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            session_start();
            /*if (!isset($_COOKIE['studyhub']) || $user['nom'] !== $_SESSION['nom']) {
                // Si le cookie n'est pas défini, déconnecter l'utilisateur
                session_start();
                
                // Supprimer les variables de session et détruire la session
                session_unset();
                session_destroy();
                
                // Supprimer les cookies (si existants)
                setcookie('studyhub', '', time() - 3600, "/");
                setcookie('nom', '', time() - 3600, "/");
            
                // Rediriger vers la page de connexion
            }*/
            // Déchiffre le mot de passe stocké
            $decryptedPassword = decryptPassword($user['mdp'], $key);

            // Compare les mots de passe
            if ($decryptedPassword === $mdp) {
                if ($user['metier'] === 'unban') {
                    $_SESSION['user_id'] = $user['idu'];
                    $_SESSION['nom'] = $user['nom'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_role'] = $user['rol'];
                    $userData = json_encode([
                        'email' => $email,
                        'nom' => $user['nom'],
                        'role' => $user['rol']
                    ]);
                    setcookie('studyhub', $userData, time() + (86400 * 30), "/"); // Cookie valide pendant 30 jours

                        if ($remember) {
                            setcookie('nom', $email, time() + (86400 * 30), "/"); // Valable pendant 30 jours
                        } else {
                            setcookie('nom', '', time() - 3600, "/"); // Supprime le cookie
                        }
                            if (in_array($user['rol'], ['admin', 'prof'])) {
                                header('Location: http://localhost/login6/view/back/university/index.php');
                                exit();
                            } elseif ($user['rol'] === 'etudiant') {
                                header('Location: index.php');
                                exit();
                            }
                            } else {
                                header('Location: http://localhost/login6/view/back/university/404.php'); // Mauvais mot de passe
                                exit();
                            }
                        } else {
                            $alert = "Mot de passe incorrect.";
                        }
                    }
                    else{
                        $alert = "Utilisateur introuvable.";
                    }
                } catch (PDOException $e) {
                    // Redirige vers une page d'erreur en cas de problème avec la base de données
                    header('Location: error.php');
                    exit();
                }
            }
            include 'login.php';
?>
