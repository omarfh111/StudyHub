<?php 
require_once 'C:\xampp\htdocs\project\config.php';
require_once 'C:\xampp\htdocs\project\controller\cartcontroller.php';
require_once 'C:\xampp\htdocs\project\vendor\autoload.php';

//$CartController = new CartController();
$idu = 9;
$user_id = $idu;

// Obtenez les produits du panier
//$cartItems = $CartController->getCartItems($user_id);                   
 // Préparer et exécuter la requête de mise à jour
$query = $db->prepare(
'UPDATE cart SET 
statut = :statut
WHERE user_id = :user_id'
);


$query->execute([
':statut' => 1,
':user_id' => $user_id
]);
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