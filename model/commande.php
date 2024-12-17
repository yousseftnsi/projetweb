<?php
class Commande {
    private $id_commande;
    private $id_user;
    private $date_commande;
    private $total_price;

    public function __construct($id_commande, $id_user, $date_commande, $total_price) {
        $this->id_commande = $id_commande;
        $this->id_user = $id_user;
        $this->date_commande = $date_commande;
        $this->total_price = $total_price;
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function getIdCommande() {
        return $this->id_commande;
    }

    public function getDateCommande() {
        return $this->date_commande;
    }

    public function getTotalPrice() {
        return $this->total_price;
    }
}


