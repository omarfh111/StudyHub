<?php
require 'vendor/autoload.php';

// Set your secret key
\Stripe\Stripe::setApiKey('sk_test_51QRAvuGCbEvzwn6bRdqMY6mR8UZXyQJha9WMtYUJN5bEqww2dkOwn9kBU0kwCFi65fsNJ2JwUaorYMq7IFTGkljE00JoKNa9Pw');

// Get the payment method ID from the request
$data = json_decode(file_get_contents('php://input'), true);
$paymentMethodId = $data['paymentMethodId'];

try {
    // Create a payment intent
    $intent = \Stripe\PaymentIntent::create([
        'amount' => 9999, 
        'currency' => 'dt',
        'payment_method' => $paymentMethodId,
        'confirmation_method' => 'manual',
        'confirm' => true,
    ]);

    // Respond with success
    http_response_code(200);
    echo json_encode(['success' => true, 'paymentIntent' => $intent]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Respond with error
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
