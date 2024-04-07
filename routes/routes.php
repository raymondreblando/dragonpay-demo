<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/init.php';

use App\Http\Requests\StoreCartRequest;

Flight::set('flight.views.path', 'resources/views');

// Display the main page
Flight::route('/', function () use ($products, $cartSession) {
   if (isset($_SESSION['payref'])) {
      unset($_SESSION['payref']);
   }

	Flight::render('index.php', [
      'products'=> $products->index(), 
      'cart_quantity' => $cartSession->getTotalQuantity()
   ]);
});

// Display the cart page
Flight::route('GET /cart', function () use ($cartSession) {
   Flight::render('cart.php', ['cart' => $cartSession]);
});

// Display the payment notification page
Flight::route('GET /payment/notify', function () {
   if (! isset($_SESSION['payref'])) {
      Flight::redirect('/');
   }

   $refno = $_SESSION['payref'] ?? null;

   Flight::render('payment-notify.php', ['refno' => $refno]);
});

// POST Request for adding items to cart
Flight::route('POST /cart', function () use ($carts, $cartSession) {
   $payload = Flight::request()->data->getData();

   $request = new StoreCartRequest($payload);
   $validated = $request->validate();

   if (count($validated->errors) > 0) {
      return Flight::halt(422, json_encode($validated));
   }

   $response = $carts->store($validated->data, $cartSession);
   return Flight::halt(200, json_encode($response));
});

// POST Request for payment processing
Flight::route('POST /pay', function () use ($payments, $cartSession) {
   $payload = [
      'Amount' => $cartSession->getTotalAmount(),
      'Currency' => 'PHP',
      'Description' => 'Dragonpay demo payment transaction',
      'Email' => 'testraymond@dragonpay.ph'
   ];

   $response = $payments->processPayment($payload, $cartSession);
   $jsonResponse = (object) json_decode($response, true);

   if (
      isset($response->error) 
      || (isset($jsonResponse->Status) && $jsonResponse->Status == 'F') 
      || (isset($jsonResponse->scalar))
   ) {
      return Flight::halt(404, 'An error occur. Try again');
   }

   Flight::halt(200, json_encode($jsonResponse));
});

// GET request if payment was succeeded
Flight::route('GET /pay/success', function () use ($payments, $cartSession) {
   $status = Flight::request()->query->status;
   $refno = Flight::request()->query->refno;

   if (isset($status) && $status == 'F') {
      return Flight::halt(404, 'Payment was unsuccessful');
   }

   $payments->processOrder($cartSession);
   $_SESSION['payref'] = $refno;
   Flight::redirect('/payment/notify');
});