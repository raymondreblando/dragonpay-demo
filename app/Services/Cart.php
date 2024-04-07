<?php

namespace App\Services;

class Cart
{
    private $total = 0;

    /**
     * Initialize a new cart session
     * 
     * @return void
     */
    public function __construct()
    {
        if (! isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    /**
     * Return all the cart items
     * 
     * @return array
     */
    public function getItems(): array
    {
        return $_SESSION['cart'];
    }

    /**
     * Remove all items from the cart
     * 
     * @return void
     */
    public function removeAllItems(): void
    {
        $_SESSION['cart'] = [];
    }

    /**
     * Insert a new item
     * 
     * @param array $item Item information
     * @return void
     */
    public function addItem(array $item): void
    {
        $key = $item['product_id'];

        if (! isset($_SESSION['cart'][$key])) {
            $_SESSION['cart'][$key] = $item;
        } else {
            $_SESSION['cart'][$key]['quantity'] += 1;
        }
    }

    /**
     * Update the item quantity
     * 
     * @param string $key The item unique key
     * @param string $operator The operator to be applied
     * @return bool
     */
    public function updateQuantity(string $key, string $operator): bool
    {
        if (! isset($_SESSION['cart'][$key])) {
            return false;  
        }

        if ($operator == '+') {
            $_SESSION['cart'][$key]['quantity'] += 1;
        } elseif ($operator == '-' && $_SESSION['cart'][$key]['quantity'] > 1) {
            $_SESSION['cart'][$key]['quantity'] -= 1;
        } elseif ($operator == '-' && $_SESSION['cart'][$key]['quantity'] < 1) {
            unset($_SESSION['cart'][$key]);
        }

        return true;
    }

    /**
     * Return the cart items total quantity
     * 
     * @return int
     */
    public function getTotalQuantity(): int
    {
        if (count($_SESSION['cart']) < 1) {
            return 0;
        }

        $quantities = array_column($_SESSION['cart'], 'quantity');
        return array_reduce($quantities, function ($carry, $item) {
            return $carry + $item;
        });
    }

    /**
     * Return the cart total amount
     * 
     * @return int
     */
    public function getTotalAmount(): int
    {
        foreach ($_SESSION['cart'] as $item) {
            $this->total += $item['price'] * $item['quantity'];
        }

        return $this->total;
    }
}