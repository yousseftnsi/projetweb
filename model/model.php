<?php

class Product{
    private $id_product;
    private $name;
    private $price;
    private $id_cat;

    private $description;

    private $image;

    public function __construct($id_product,$name,$price,$id_cat,$description,$image) {
        $this->id_product=$id_product;
        $this->name = $name;
        $this->price = $price;
        $this->id_cat = $id_cat;
        $this->description = $description;
        $this->image = $image;
    }


    public function getId()
    {
        return $this->id_product;
    }


    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of id_cat
     */ 
    public function getid_cat()
    {
        return $this->id_cat;
    }

    /**
     * Set the value of id_cat
     *
     * @return  self
     */ 
    public function setid_cat($id_cat)
    {
        $this->id_cat = $id_cat;

        return $this;
    }
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }
}



class category{
    private $id_category;
    private $titre;


    public function __construct($id_category,$titre) {
        $this->id_category=$id_category;
        $this->titre = $titre;

    }

    public function getid_category()
    {
        return $this->id_category;
    }
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

   

}




class ProductM{
    private $id_product;
    private $name;
    private $price;
    private $id_cat;

    private $description;


    public function __construct($id_product,$name,$price,$id_cat,$description) {
        $this->id_product=$id_product;
        $this->name = $name;
        $this->price = $price;
        $this->id_cat = $id_cat;
        $this->description = $description;
    }


    public function getId()
    {
        return $this->id_product;
    }


    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of id_cat
     */ 
    public function getid_cat()
    {
        return $this->id_cat;
    }

    /**
     * Set the value of id_cat
     *
     * @return  self
     */ 
    public function setid_cat($id_cat)
    {
        $this->id_cat = $id_cat;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
 
}


?>