<?php
require 'vendor/autoload.php'; // Include the Stripe PHP library

\Stripe\Stripe::setApiKey('sk_test_51Nv4x3DluAG2hlhfkEI0HcHnUDSWxTwtMRl8hzlxXB2qKDjv1c6WWxHpsx6VGHEoRicC7ARJJpivsaubPaVlUJbS00WsINm5Bg'); // Replace with your Stripe secret key

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];

    // Convert the amount to cents (Stripe requires amounts in cents)
    $amount_cents = $amount * 100;

    try {
        // Create a charge
        $charge = \Stripe\Charge::create([
            'amount' => $amount_cents,
            'currency' => 'usd', // Change to your desired currency
            'source' => $_POST['stripeToken'],
            'description' => 'Payment for Your Product/Service',
        ]);

        // Payment successful
        echo 'Payment was successful. Charge ID: ' . $charge->id;
    } catch (\Stripe\Exception\CardException $e) {
        // Payment failed due to a card error
        echo 'Payment failed: ' . $e->getMessage();
    } catch (Exception $e) {
        // Payment failed for other reasons
        echo 'Payment failed: ' . $e->getMessage();
    }
}
?>
