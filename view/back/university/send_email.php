<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\login6\vendor\autoload.php';// Inclut PHPMailer depuis Composer

function sendEmailToUser($email, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // Configuration SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Serveur SMTP (Gmail)
        $mail->SMTPAuth = true;
        $mail->Username = 'mimoplay6394739@gmail.com'; // Votre adresse email
        $mail->Password = 'xrcq kyav rebi qatf';    // Votre mot de passe ou clé d'application
        $mail->SMTPSecure = 'ssl'; // Chiffrement TLS
        $mail->Port = 465;

        // Expéditeur et destinataire
        $mail->setFrom('mimoplay6394739@gmail.com', ' Prof StudyHub');
        $mail->addAddress($email); // Email du destinataire

        // Contenu
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        // Envoyer l'email
        $mail->send();
        return true; // Succès
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi de l'email : {$mail->ErrorInfo}";
        return false; // Échec
    }
}
?>
