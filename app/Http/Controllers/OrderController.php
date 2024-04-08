<?php

namespace App\Http\Controllers;

use App\Helpers\Utilities;
use App\Services\DbHelper;

class OrderController extends Controller
{
   private $_DbHelper;

   /**
     * Inject the database helper
     * 
     * @param DbHelper $DbHelper DbHelper instance
     * @return void
     */
   public function __construct(DbHelper $DbHelper,)
   {
      $this->_DbHelper = $DbHelper;
   }

   /**
    * Show all orders
    *
    * @return array
    */
   public function index(): array
   {
      $query = 'SELECT * FROM `orders` ORDER BY `id` DESC';
      $this->_DbHelper->query($query);

      return $this->_DbHelper->fetchAll();
   }

   /**
    * Insert a new order in the database
    *
    * @param object $payload Order information
    * @return bool
    */
   public function store(object $payload): bool
   {
      $current_date = Utilities::getCurrentDate();

      $query = 'INSERT INTO `orders` (`txnid`, `refno`, `amount`, `date_created`, `date_updated`) VALUES (?, ?, ?, ?, ?)';

      $this->_DbHelper->query($query, [
         $payload->txnid, 
         $payload->RefNo, 
         $payload->amount, 
         $current_date, 
         $current_date
      ]);

      if ($this->_DbHelper->rowCount() == 0) {
         return false;
      } 

      return true;
   }

   /**
    * Update the order details
    *
    * @param string $txnid The unique indetifier of the order
    * @param string $status
    * @return void
    */
   public function update(string $txnid, string $status): void
   {
      $current_date = Utilities::getCurrentDate();

      $query = 'UPDATE `orders` SET `status` = ?, `date_updated` = ? WHERE `txnid` = ?';
      $this->_DbHelper->query($query, [$status, $current_date, $txnid]);
   }
}