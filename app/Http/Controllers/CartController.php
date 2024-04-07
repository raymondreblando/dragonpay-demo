<?php

namespace App\Http\Controllers;

use App\Services\Cart;
use App\Services\DbHelper;

class CartController extends Controller
{
    private $_DbHelper;

    /**
     * Inject the database helper
     * 
     * @param DbHelper $DbHelper DbHelper instance
     * @return void
     */
    public function __construct(DbHelper $DbHelper)
    {
        $this->_DbHelper = $DbHelper;
    }

    /**
     * Store a new record in cart session
     * 
     * @param object $payload Item information
     * @param Cart $cart Cart instance
     * @return array
     */
    public function store(object $payload, Cart $cart): array
    {
        $query = 'SELECT `product_id`, `name`, `brand`, `price` FROM `products` WHERE `product_id` = ?';
        $this->_DbHelper->query($query, [$payload->product_id]);
        $product = $this->_DbHelper->fetch();
        $product->quantity = 1;

        $cart->addItem((array) $product);

        return [
            'data' => $cart->getTotalQuantity(),
            'message' => 'Added to cart'
        ];
    }
}