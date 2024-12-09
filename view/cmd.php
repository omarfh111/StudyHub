<?php 
require_once 'C:\xampp\htdocs\project\config.php';
require_once 'C:\xampp\htdocs\project\controller\offercontroller.php';
$OfferController = new OfferController();


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
            <button type="submit">Pay	</button>
        </form>
    </div>

    <script>
        // Stripe Initialization
        const stripe = Stripe('YOUR_PUBLISHABLE_KEY');
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
                // Send paymentMethod.id to your server
                fetch('/process_payment.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ paymentMethodId: paymentMethod.id }),
                }).then(response => {
                    if (response.ok) {
                        alert('Payment successful!');
                    } else {
                        alert('Payment failed. Please try again.');
                    }
                });
            }
        });
    </script>
</body>
</html>
