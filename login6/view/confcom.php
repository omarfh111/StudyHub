<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require_once 'C:\xampp\htdocs\login6\config.php';
//session_start(); // Assurez-vous que les sessions sont activées

// Vérifier si un utilisateur est connecté
if (isset($_COOKIE['studyhub'])) {
    // Décoder les données du cookie
    $userData = json_decode($_COOKIE['studyhub'], true);
    $email = $userData['email'];
    $name = $userData['nom']; // Assurez-vous que le prénom est également stocké dans la session

    //echo "Débogage : préparation à envoyer l'email de confirmation à $email<br>";

    try {
        // Envoyer l'email de confirmation de commande
        sendOrderConfirmationEmail($name, $email);
        //echo "La confirmation de commande a été envoyée à votre e-mail.";
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi de l'email : " . $e->getMessage();
    }
} else {
    echo "Erreur : aucun utilisateur connecté.";
}
function sendOrderConfirmationEmail($name, $email) {
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0; // Désactiver les messages de débogage pour les utilisateurs
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
        $logoUrl = 'http://localhost/login6/view/images/logo.png'; // Remplacez par l'URL de votre logo
        $mail->setFrom('mimoplay6394739@gmail.com', 'studyhub');
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        $mail->Subject = 'Confirmation de votre commande';
        $mail->Body    = "
        <div style='font-family: Arial, sans-serif; font-size: 16px; line-height: 1.5; color: #333;'>
            <div style='text-align: center; margin-bottom: 20px;'>
                <img src='$logoUrl' alt='StudyHub Logo' style='max-width: 200px; height: auto;' />
            </div>
            <p>Bonjour <b>$name</b>,</p>
            <p>Nous vous confirmons que votre commande a été enregistrée avec succès.</p>
            <p>Merci pour votre confiance et à bientôt sur notre site.</p>
            <p style='text-align: center; margin-top: 30px;'>
                <a href='http://localhost/login6/view/login.php' style='display: inline-block; background-color: #0078d4; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px;'>Visitez notre site</a>
            </p>
            <br>
            <p style='color: #999; font-size: 14px; text-align: center;'>
                Cordialement,<br>L'équipe StudyHub.
            </p>
        </div>
        ";

        // Envoyer le mail
        $mail->send();
        //echo "E-mail de confirmation envoyé avec succès.";
    } catch (Exception $e) {
        echo "Le message n'a pas pu être envoyé. Erreur Mailer : {$mail->ErrorInfo}";
    }
}



?>
