<?php
class Panier {
    public function __construct() {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }
    }

    public function addProduct($id_product, $name, $price, $quantity) {
        $_SESSION['panier'][] = [
            'id_product' => $id_product,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity
        ];
    }

    public function updateQuantity($id_product, $new_quantity) {
        foreach ($_SESSION['panier'] as &$item) {
            if ($item['id_product'] == $id_product) {
                $item['quantity'] = $new_quantity;
                break;
            }
        }
    }

    public function removeProduct($id_product) {
        $_SESSION['panier'] = array_filter($_SESSION['panier'], function($item) use ($id_product) {
            return $item['id_product'] != $id_product;
        });
        $_SESSION['panier'] = array_values($_SESSION['panier']); // Réindexer le tableau après suppression
    }

    public function getPanier() {
        return $_SESSION['panier'];
    }
}
