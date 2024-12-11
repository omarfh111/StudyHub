<?php
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('your_secret_key');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Create a new Checkout Session
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $_POST['nompp'],
                            'description' => $_POST['desc'],
                        ],
                        'unit_amount' => $_POST['prix_p'] * 100, // Convert to cents for Stripe
                    ],
                    'quantity' => $_POST['quantite'],
                ],
            ],
            'mode' => 'payment',
            'success_url' => 'your-redirect-url-after-payment?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'your-cancel-url',
        ]);

        header('Location: ' . $session->url);
        exit();

    } catch (\Stripe\Exception\ApiErrorException $e) {
        echo 'Error: ' . $e->getMessage();
        exit();
    }
}
?>
