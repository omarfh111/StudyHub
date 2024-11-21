<?php
    require_once '../controller/UserController.php'; // Adjust the path if necessary
    $key='00';
    function encryptPassword($password, $key) {
        $cipherMethod = 'AES-256-CBC';
        $ivLength = openssl_cipher_iv_length($cipherMethod);
        $iv = openssl_random_pseudo_bytes($ivLength);
        $encryptedPassword = openssl_encrypt($password, $cipherMethod, $key, 0, $iv);
        return base64_encode($iv . $encryptedPassword);
    }
    function checkEmailExists($email) {
        // Connexion à la base de données
        $db = Config::getConnexion(); // Assurez-vous que la classe Config est correctement définie
    
        $sql = "SELECT COUNT(*) FROM user WHERE email = :email";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    
        try {
            $stmt->execute();
            $count = $stmt->fetchColumn();
    
            if ($count > 0) {
                return true; // L'email existe déjà
            } else {
                return false; // L'email est disponible
            }
        } catch (PDOException $e) {
            die("Erreur lors de la vérification de l'email : " . $e->getMessage());
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email'] ?? '');
        if (checkEmailExists($email)) {
            echo "Cette adresse e-mail est déjà utilisée. Veuillez en choisir une autre.";
        } else {
        // Sanitize and retrieve form data
        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
        
        $naissance = trim($_POST['naissance'] ?? '');
        $tel = trim($_POST['tel'] ?? '');
        $mdp = trim($_POST['mdp'] ?? '');

        // Basic validation

            $userController = new UserController();
            $result = $userController->addUser($nom, $prenom, $email, $naissance, $tel, encryptPassword($mdp, $key), null, "etudiant");

            if ($result) {
                echo "<p>User added successfully!</p>";
            } else {
                echo "<p>Failed to add user.</p>";
            }
        }
    }
    ?>