<?php
require "../config.php";

class ProductController
{
    // select all product list
    public function productList()
    {
        $sql = "SELECT * FROM product";
        $conn = config::getConnexion();

        try {
            $liste = $conn->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    function getProductById($id)
    {
        $sql = "SELECT * from product where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $product = $query->fetch();
            return $product;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // add new product
    public function addProduct($product)
    {
        $sql = "INSERT INTO product (id,name,price,id_cat,description,image)
        VALUES (:id,:name,:price,:id_cat,:description,:image)";
        $conn = config::getConnexion();

        try {
            $query = $conn->prepare($sql);
            $query->execute(['id'=> $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'id_cat' => $product->getid_cat(),
                'description' => $product->getDescription(),
                'image' => $product->getImage(),

            ]);
            echo "product inserted succcefully";
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function updateProduct($product, $id)
    {
        $db = config::getConnexion();

        $query = $db->prepare(
            'UPDATE product SET 
                name = :name,
                price = :price,
                id_cat = :id_cat,
                description = :description
            WHERE id = :id'
        );
        try {
            $query->execute([
                'id' => $id,
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'id_cat' => $product->getid_cat(),
                'description' => $product->getDescription(),
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }




    // delete one product by id
    public function deleteProduct($id)
    {
        $sql = "DELETE FROM product WHERE id=:id";
        $conn = config::getConnexion();
        $req = $conn->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function productList1()
    {
        // Ensure you're selecting the 'id_category' field from the category table as well
        $sql = "SELECT p.*, c.id_category, c.titre AS category_name 
                FROM product p 
                JOIN category c ON p.id_cat = c.id_category";
        
        $db = config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll(); // This will now include the 'id_category' from the category table
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    
}

class CategoryController
{
    // select all product list
    public function CategoryList()
    {
        $sql = "SELECT * FROM category";
        $conn = config::getConnexion();

        try {
            $liste = $conn->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }



    function afficherCategoryId($numse){
        $sql="SELECT * FROM category WHERE `id_category`= $numse ";
        $db=config::getConnexion();
        try{
            $liste=$db->query($sql);
            return $liste;
        }
        catch(Exception $e){
            die("erreur:".$e->getMessage());
        }
    } 


    // add new product
    public function addcategory($category)
    {
        $sql = "INSERT INTO category (id_category,titre)
        VALUES (NULL,:titre)";
        $conn = config::getConnexion();

        try {
            $query = $conn->prepare($sql);
            $query->execute([
                'titre' => $category->getTitre(),
                

            ]);
            echo "category inserted succcefully";
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function ModifierCategory($ser)
{
$sqlc= "UPDATE `category` SET titre=:titre  WHERE id_category=:id_category ";
$db=config::getConnexion();
try{ $recipesStatement = $db->prepare($sqlc);
	$recipesStatement->execute([ 'titre'=>$ser->getTitre(),
			'id_category' =>$ser->getid_category(),

		         ]);
}
 catch(Exception $e){ 
 	
			 die("erreur:".$e->getMessage());
}

}



    // delete one product by id
    public function deleteCategory($id_category)
    {
        $sql = "DELETE FROM category WHERE id_category=:id_category";
        $conn = config::getConnexion();
        $req = $conn->prepare($sql);
        $req->bindValue(':id_category', $id_category);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

   
}
