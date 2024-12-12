<?php 
require_once 'C:\xampp\htdocs\project\config.php';
require_once 'C:\xampp\htdocs\project\controller\cartcontroller.php';
require_once 'C:\xampp\htdocs\project\vendor\autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$idu = 9; // Static user ID
$user_id = $idu;

try {
    // Step 1: Retrieve the cart items for the user
    $cartQuery = $db->prepare("SELECT idp, quantite FROM cart WHERE user_id = :user_id and statut=0");
    $cartQuery->execute([':user_id' => $user_id]);
    $cartItems = $cartQuery->fetchAll(PDO::FETCH_ASSOC);

    // Step 2: Update product quantities in the produit table
    foreach ($cartItems as $item) {
        $updateProduitQuery = $db->prepare(
            "UPDATE produit SET quantite = quantite - :quantite WHERE idp = :idp"
        );
        $updateProduitQuery->execute([
            ':quantite' => $item['quantite'],
            ':idp' => $item['idp']
        ]);
    }

    // Step 3: Update the cart status
    $updateCartQuery = $db->prepare(
        'UPDATE cart SET statut = :statut WHERE user_id = :user_id'
    );
    $updateCartQuery->execute([
        ':statut' => 1,
        ':user_id' => $user_id
    ]);

} catch (PDOException $e) {
    // Handle errors
    echo "Error: " . $e->getMessage();
    exit;
}


try {
    // Server settings
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'hamzafhaiel1004@gmail.com';
    $mail->Password = 'zawd ukur rdcd ximy'; // Use App Password here
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    
    $mail->setFrom('your_email@gmail.com', 'studyhub');
    $mail->addAddress('recipient_email@example.com');
    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = 'This is a test email.';
    

    // Recipients
    $mail->setFrom('your_email@gmail.com','studyhub');
    $mail->addAddress('hamzafhaiel1004@gmail.com'); // Recipient's email

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Confirmation de Paiement';
    $mail->Body    = '<h1>Paiement Réussi</h1><p>Merci pour votre achat.</p>';
    $mail->AltBody = 'Paiement Réussi. Merci pour votre achat.';

    $mail->send();
    //echo 'Email sent successfully';
} catch (Exception $e) {
    echo "Error sending email: {$mail->ErrorInfo}";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement Réussi</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to right, #4caf50, #81c784);
            font-family: Arial, sans-serif;
            color: white;
        }

        .container {
            text-align: center;
            animation: fadeIn 1.5s ease-in-out;
        }

        .checkmark {
            display: inline-block;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: white;
            position: relative;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .checkmark::after {
            content: '';
            position: absolute;
            left: 40px;
            top: 10px;
            width: 20px;
            height: 60px;
            border: solid #4caf50;
            border-width: 0 8px 8px 0;
            transform: rotate(45deg);
            animation: drawCheckmark 0.5s ease-out 0.5s forwards;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 10px;
            animation: slideDown 1s ease-in-out;
        }

        p {
            font-size: 1.2rem;
            animation: slideUp 1s ease-in-out;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }

        button:hover {
            background-color: #0056b3;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes drawCheckmark {
            from {
                width: 0;
                height: 0;
            }
            to {
                width: 20px;
                height: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="checkmark"></div>
        <h1>Paiement Réussi !</h1>
        <p>Merci pour votre achat.</p>
        <button onclick="window.location.href='affichage.php'">Retour à l'accueil</button>
    </div>
</body>
</html>
