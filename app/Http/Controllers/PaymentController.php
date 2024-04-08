<?php

namespace App\Http\Controllers;

use App\Services\Cart;
use App\Services\HttpClient;
use stdClass;

class PaymentController extends Controller
{
   private $_httpClient;

   /**
    * Inject the http client instance
    * 
    * @param HttpClient $httpClient HttpClient instance
    * @return void
    */
   public function __construct(HttpClient $httpClient)
   {
      $this->_httpClient = $httpClient;
   }

   /**
    * Process the payment request
    * @param array $payload Payment details
    * @param string $txnid Unique identifier
    * @param Cart $cart Cart instance
    * @return stdClass|bool|string
    */
   public function processPayment(
      array $payload, 
      string $txnid, 
      Cart $cart
   ): stdClass|bool|string {
      $this->_httpClient->init();
      $response = $this->_httpClient->post($payload, $txnid);

      if ($this->_httpClient->hasError()) {
         return (object) [
            'error' => 'An error occur. Try again'
         ];
      }
      
      $this->_httpClient->destroy();
      return $response;
   }
}