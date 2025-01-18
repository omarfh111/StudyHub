<?php
require_once 'C:/xampp/htdocs/login6/config.php';
require_once 'C:/xampp/htdocs/login6/controller/reponseC.php';
require_once 'C:/xampp/htdocs/login6/model/reponseM.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclure PHPMailer
require_once 'C:/xampp/htdocs/login6/controller/PHPMailer/src/Exception.php';
require_once 'C:/xampp/htdocs/login6/controller/PHPMailer/src/PHPMailer.php';
require_once 'C:/xampp/htdocs/login6/controller/PHPMailer/src/SMTP.php';

$host = 'smtp.gmail.com';
$port = 587;
$username = 'hibadkhil7@gmail.com';
$password = 'uauz tzxw nzqr itiv';

$connection = fsockopen($host, $port);

if (!$connection) {
    echo "Impossible de se connecter au serveur SMTP.";
} else {
    echo "Connexion réussie au serveur SMTP.";
    fclose($connection);
}

// Initialisation de PHPMailer
$mail = new PHPMailer(true); // Ajoutez cette ligne

// Débogage
$mail->SMTPDebug = 2; // Affiche les détails de débogage SMTP
$mail->Debugoutput = 'html'; // Affiche les détails dans un format lisible



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $id_rec = filter_input(INPUT_POST, 'id_rec', FILTER_SANITIZE_NUMBER_INT);
    $reponse = filter_input(INPUT_POST, 'reponse', FILTER_SANITIZE_STRING);
    $reponse = htmlspecialchars($_POST['reponse'], ENT_QUOTES, 'UTF-8');
    
    if (empty($reponse)) {
        
        header('Location: ../View/back/university/view-reponse.php?message=error_fields');
        exit();
    }

    $id_rec = filter_input(INPUT_POST, 'id_rec', FILTER_SANITIZE_NUMBER_INT);
    if (empty($id_rec)) {
       
        header('Location: ../View/back/university/view-reponse.php?message=error_fields');
        exit();
    }

    try {
       
        $pdo = config::getConnexion();
        $query = $pdo->prepare("SELECT email FROM reclamation WHERE id_rec = :id_rec");
        $query->bindParam(':id_rec', $id_rec, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            header('Location: ../View/back/university/view-reponse.php?message=error_not_found');
            exit();
        }

        $email = $result['email']; // Email de l'utilisateur

        // Configuration de PHPMailer
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;

        $mail->Host = 'smtp.gmail.com';
        $mail->Username = 'hibadkhil7@gmail.com';
        $mail->Password = 'uauz tzxw nzqr itiv';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Configuration de l'email
        $mail->setFrom('hibadkhil7@gmail.com', 'Support StudyHub');
        $mail->addAddress($email); // Email récupéré
        $mail->Subject = "Reponse a votre reclamation #$id_rec";
        $mail->Body = "Bonjour,\n\nVoici notre réponse à votre réclamation :\n\n$reponse\n\nCordialement,\nL'équipe StudyHub.";
        
        // Envoyer l'email
        if ($mail->send()) {
            $reponseController = new ReponseC();
            $reponseController->ajouterReponse($id_rec, $reponse);
            header('Location: ../View/back/university/view-reponse.php?message=success');
            exit();
        } else {
            error_log("Erreur lors de l'envoi de l'email : " . $mail->ErrorInfo);
            header('Location: ../View/back/university/view-reponse.php?message=email_error');
            exit();
        }
    } catch (Exception $e) {
        error_log("Erreur : " . $e->getMessage());
        header('Location: ../View/back/university/view-reponse.php?message=server_error');
        exit();
    }
}
?>
