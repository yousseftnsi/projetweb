<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/panier.php';

// Verify if the user is logged in
if (!isset($_SESSION['id_user'])) {
    header('Location: ../view/front/login.php'); // Adjust path according to your structure
    exit();
}

$panier = new Panier();

// Handle adding a product to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $id_product = $_POST['id_product'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
        $panier->addProduct($id_product, $name, $price, $quantity);
    }

    // Handle cart updates (quantity changes or removal)
    if (isset($_POST['update_quantity'])) {
        $id_product = $_POST['id_product'];
        $new_quantity = $_POST['new_quantity'];
        $panier->updateQuantity($id_product, $new_quantity);
    }

    if (isset($_POST['remove_item'])) {
        $id_product = $_POST['id_product'];
        $panier->removeProduct($id_product);
    }

    header('Location: ../view/front/panier.php'); // Adjust path according to your structure
    exit();
}

// Fetch the cart contents from the session
$lignesPanier = $panier->getPanier();
