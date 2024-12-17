<?php
/*class LigneCommandee {
    private $idLigneCommande;
    private $idCommande;
    private $idProduct;
    private $quantity;
    private $unitPrice;
    private $totalPrice;

    public function __construct($idLigneCommande, $idCommande, $idProduct, $quantity, $unitPrice, $totalPrice) {
        $this->idLigneCommande = $idLigneCommande;
        $this->idCommande = $idCommande;
        $this->idProduct = $idProduct;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
        $this->totalPrice = $totalPrice;
    }

    // Add getters and setters as needed


    // Getters
    public function getIdLigne() { return $this->id_ligne; }
    public function getIdCommande() { return $this->id_commande; }
    public function getIdProduit() { return $this->id_produit; }
    public function getQuantite() { return $this->quantite; }
    public function getPrixUnitaire() { return $this->prix_unitaire; }

    // Setters
    public function setIdCommande($id_commande) { $this->id_commande = $id_commande; }
    public function setIdProduit($id_produit) { $this->id_produit = $id_produit; }
    public function setQuantite($quantite) { $this->quantite = $quantite; }
    public function setPrixUnitaire($prix_unitaire) { $this->prix_unitaire = $prix_unitaire; }
}*/
class LigneCommandee {
    private $id_ligne_commande;
    private $id_commande;
    private $id_product;
    private $quantity;
    private $unit_price;
    private $total_price;

    public function __construct($id_ligne_commande, $id_commande, $id_product, $quantity, $unit_price, $total_price) {
        $this->id_ligne_commande = $id_ligne_commande;
        $this->id_commande = $id_commande;
        $this->id_product = $id_product;
        $this->quantity = $quantity;
        $this->unit_price = $unit_price;
        $this->total_price = $total_price;
    }

    public function getIdLigneCommande() {
        return $this->id_ligne_commande;
    }

    public function getIdCommande() {
        return $this->id_commande;
    }

    public function getIdProduct() {
        return $this->id_product;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getUnitPrice() {
        return $this->unit_price;
    }

    public function getTotalPrice() {
        return $this->total_price;
    }
}



?>
