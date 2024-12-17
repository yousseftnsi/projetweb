<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/panier.php';

/*
//////
     public static function addLigneCommandee($ligneCommandee) {
        $pdo = config::getConnexion();
        $stmt = $pdo->prepare("INSERT INTO ligne_commande (id_commande,id_product,quantity, unit_price) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $ligneCommandee->getIdCommande(),
            $ligneCommandee->getIdProduit(),
            $ligneCommandee->getQuantite(),
            $ligneCommandee->getPrixUnitaire()
        ]);
    }
    //////
        public static function getLignesByCommandeId($id_commande) {
        try{
        $pdo = config::getConnexion();
        $stmt = $pdo->prepare("SELECT * FROM ligne_commande WHERE id_commande = id_commande");
        $stmt->execute(["id_commande" =>$id_commande]);
        return $stmt->fetchAll();
    }catch(PDOException $e){
        echo $e->getMessage();
    }}///////////
    public function getLignesByCommandeId($id_commande) {
    $sql = "SELECT * FROM ligne_commandee WHERE id_commande = :id_commande";
    try {
        $query = $this->db->prepare($sql);
        $query->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll();
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
class LigneCommandeeController {
    private $db;

    public function __construct() {
        $this->db = config::getConnexion();
    }

    public function getLignesByCommandeId($id_commande) {
        $sql = "SELECT * FROM ligne_commande WHERE id_commande = :id_commande";
        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}

    
*/

class LigneCommandeeController {
    public function __construct() { $this->db = config::getConnexion(); }
    
    public function getLignesByCommandeId($id_commande) {
        $sql = "SELECT * FROM ligne_commande WHERE id_commande = :id_commande";
        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    

        public static function addLigneCommandee($ligneCommandee) {
            $db = config::getConnexion();
            $sql = "INSERT INTO ligne_commande (id_commande, id_product, quantity, unit_price, total_price) 
                    VALUES (:id_commande, :id_product, :quantity, :unit_price, :total_price)";
            try {
                $query = $db->prepare($sql);
                $query->bindValue(':id_commande', $ligneCommandee->getIdCommande(), PDO::PARAM_INT);
                $query->bindValue(':id_product', $ligneCommandee->getIdProduct(), PDO::PARAM_INT);
                $query->bindValue(':quantity', $ligneCommandee->getQuantity(), PDO::PARAM_INT);
                $query->bindValue(':unit_price', $ligneCommandee->getUnitPrice(), PDO::PARAM_STR);
                $query->bindValue(':total_price', $ligneCommandee->getTotalPrice(), PDO::PARAM_STR);
                $query->execute();
                return true; // Return true if successful
            } catch (Exception $e) {
                die('Error: ' . $e->getMessage());
            }
        }
        

    public static function deleteLigneById($id_ligne) {
        $pdo = config::getConnexion();
        $stmt = $pdo->prepare("DELETE FROM ligne_commande WHERE id_ligne_commande = ?");
        $stmt->execute([$id_ligne]);
    }
}
?>
