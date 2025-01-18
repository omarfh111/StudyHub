<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require_once 'C:\xampp\htdocs\login6\config.php';
require_once 'C:\xampp\htdocs\login6\model\user.php';

if (isset($_POST["email"])) {
    $email = $_POST["email"];
    $pdo = config::getConnexion();

    try {
        // Vérifier si l'email existe dans la base de données
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            $name = $user['prenom'];
            
            // Générer un code unique
            $code = bin2hex(random_bytes(16));

            // Mettre à jour le code dans la base de données
            $stmt = $pdo->prepare("UPDATE user SET code = ? WHERE email = ?");
            $stmt->execute([$code, $email]);

            // Envoyer le mail
            sendResetEmail($name, $email, $code);
            echo 'Le code de réinitialisation a été envoyé à votre email.';
        } else {
            echo 'Email introuvable dans la base de données.';
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

echo "Débogage : préparation à envoyer l'email à $email<br>";

function sendResetEmail($name, $email, $code) {
    echo "Débogage : début de l'envoi de l'email<br>";

    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0; // Affiche les messages de débogage
    $mail->Debugoutput = 'html'; // Format des logs
    try {
        // Configuration SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mimoplay6394739@gmail.com'; // Remplacez par votre email
        $mail->Password   = 'xrcq kyav rebi qatf';        // Remplacez par votre mot de passe
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // Contenu de l'email
        $mail->setFrom('mimoplay6394739@gmail.com', 'studyhub');
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        $mail->Subject = 'Code de réinitialisation du mot de passe';
        $mail->Body    = "Bonjour $name,<br><br>Voici votre code de réinitialisation : <b>$code</b><br>Veuillez l'utiliser pour changer votre mot de passe.";

        // Envoyer le mail
        $mail->send();
        echo "mail envoyes";
        header("Location: reset.php");
        exit();
    } catch (Exception $e) {
        echo "Le message n'a pas pu être envoyé. Erreur Mailer : {$mail->ErrorInfo}";
    }
}
?>
