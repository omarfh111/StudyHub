<?php 
require_once 'C:\xampp\htdocs\login6\config.php';
require_once 'C:\xampp\htdocs\login6\controller\cartcontroller.php';
require_once 'C:\xampp\htdocs\login6\vendor\autoload.php';
require_once 'C:\xampp\htdocs\login6\controller\usercontroller.php';
$CartController = new CartController();

session_start();

if (isset($_COOKIE['studyhub'])) {
  // Décoder les données du cookie
  $userData = json_decode($_COOKIE['studyhub'], true);

  $email = $userData['email'];
  $nom = $userData['nom'];
  $role = $userData['role'];

} else {
  header('Location: login.php');
  exit();
}
if (!isset($_SESSION['user_id'])) {
  die('Erreur : utilisateur non connecté.');
}

$idu = $_SESSION['user_id']; // Récupérer l'ID utilisateur depuis la session
$userController = new UserController();

// Récupérer les informations de l'utilisateur connecté
$user = $userController->getUserById($idu);
$user_id = $idu;

// Obtenez les produits du panier
$cartItems = $CartController->getCartItems($user_id);

$total = 0;

foreach ($cartItems as $item) {
    if ($item['statut'] == 0) {
        $total += $item['price'] * $item['quantite'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
        }
        #card-element {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 4px;
        }
        #card-errors {
            color: red;
            margin-top: 10px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Stripe Payment</h2>
        <form id="payment-form">
            <div id="card-element"></div>
            <div id="card-errors" role="alert"></div>
            <button type="submit" id="checkout-button">Pay <?php echo $total; ?> DT</button> <!-- Afficher le montant total dans le bouton -->
        </form>
    </div>

    <script>
        // Stripe Initialization
        const stripe = Stripe('pk_test_51QRAvuGCbEvzwn6bnEfYA72mqMZ6GEPe1861FWf3TsFmx9Br4MHfJFMDQmQlf8WGvHeBesSCTixBDmwUlSkq85oh00pho1amFi');
        const elements = stripe.elements();

        // Card Element
        const card = elements.create('card', { style: { base: { fontSize: '16px' } } });
        card.mount('#card-element');

        // Form Submission
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const { error, paymentMethod } = await stripe.createPaymentMethod({
                type: 'card',
                card: card,
            });

            if (error) {
                document.getElementById('card-errors').textContent = error.message;
            } else {
                // Send paymentMethod.id and total amount to your server
                fetch('process_payment.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ 
                        paymentMethodId: paymentMethod.id, 
                        totalAmount: <?php echo $total * 100; ?> // Convert to cents for Stripe
                    }),
                }).then(response => {
                    if (response.ok) {
                        // Redirige vers succes.php
                        window.location.href = 'succes.php';
                    } else {
                        alert('Payment failed. Please try again.');
                    }
                });
            }
        });
    </script>
</body>
</html>
