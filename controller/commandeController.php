<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/panier.php';
class CommandeController {
    private $db;

    public function __construct() {
        $this->db = config::getConnexion();
    }

    // Retrieve all commandes
    public function getAllCommandesByUserId($userId) {
    $sql = "SELECT * FROM commande WHERE id_user = :id_user";
    try {
        $query = $this->db->prepare($sql);
        $query->bindParam(':id_user', $userId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll();
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

   
    // Retrieve a specific commande by ID
    public function getCommandeById($id) {
        
        $sql = "SELECT * FROM commande WHERE id_commande = :id_commande";
        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(':id_commande', $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

   // Add a new commande
   public function addCommande($commande) {
    $sql = "INSERT INTO commande (id_user, date_commande, total_price) 
            VALUES (:id_user, :date_commande, :total_price)";
    try {
        $query = $this->db->prepare($sql);
        $query->bindValue(':id_user', $commande->getIdUser(), PDO::PARAM_INT);
        $query->bindValue(':date_commande', $commande->getDateCommande(), PDO::PARAM_STR);
        $query->bindValue(':total_price', $commande->getTotalPrice(), PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId(); // Return the ID of the inserted commande
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}



    /*public function addCommande($commande) {
        $sql = "INSERT INTO commande (id_user, date_commande, total_price) 
                VALUES (:id_user, :date_commande, :total_price)";
        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(':id_user', $commande->getIdUser(), PDO::PARAM_INT);
            $query->bindValue(':date_commande', $commande->getDateCommande(), PDO::PARAM_STR);
            $query->bindValue(':total_price', $commande->getTotalPrice(), PDO::PARAM_STR);
            $query->execute();
            return $this->db->lastInsertId(); // Return the ID of the inserted commande
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }*/
    //////
    /*public function addCommande($commande) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_user'], $_POST['date_commande'], $_POST['total_price'])) {
        $commande = new Commande();
        $commande->setIdUser($_POST['id_user']);
        $commande->setDateCommande(date('Y-m-d H:i:s')); // Use current date and time
        $commande->setTotalPrice($_POST['total_price']);

        $controller = new CommandeController();
        $controller->addCommande($commande);

        echo 'Order placed successfully';
    } else {
        echo 'Invalid data';
    }}*/




    // Update an existing commande
    public function updateCommande($commande) {
        $sql = "UPDATE commande SET 
                id_user = :id_user, 
                date_commande = :date_commande, 
                total_price = :total_price 
                WHERE id_commande = :id_commande";
        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(':id_user', $commande->getIdUser(), PDO::PARAM_INT);
            $query->bindValue(':date_commande', $commande->getDateCommande(), PDO::PARAM_STR);
            $query->bindValue(':total_price', $commande->getTotalPrice(), PDO::PARAM_STR);
            $query->bindValue(':id_commande', $commande->getIdCommande(), PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Delete a commande by ID
    public function deleteCommande($id) {
        $sql = "DELETE FROM commande WHERE id_commande = :id_commande";
        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(':id_commande', $id, PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
