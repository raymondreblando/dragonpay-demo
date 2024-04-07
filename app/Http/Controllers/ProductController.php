<?php

namespace App\Http\Controllers;

use App\Services\DbHelper;

class ProductController extends Controller
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
     * Show the product list
     * 
     * @return array
     */
    public function index(): array
    {
        $query = 'SELECT * FROM `products`';
        $this->_DbHelper->query($query);

        return $this->_DbHelper->fetchAll();
    }
}