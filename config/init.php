<?php

session_start();
require __DIR__ . '/../vendor/autoload.php';

use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Services\Cart;
use App\Services\HttpClient;
use App\Services\DbHelper;
use Config\Database;
use Dotenv\Dotenv;

// Load the environment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$httpClient = new HttpClient();
$cartSession = new Cart();

$db = new Database();
$conn = $db->connect();

$DbHelper = new DbHelper($conn);
$products = new ProductController($DbHelper);
$carts = new CartController($DbHelper);
$payments = new PaymentController($httpClient);

define('BASE_URL', $_ENV['BASE_URL']);