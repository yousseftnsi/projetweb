<?php 
include "../model/model.php";
include "../controller/ProductController.php";


if(!isset($_POST['id_category'])||!isset($_POST['titre']))
{
	echo "erreur de ";
}




$category=new category($_POST['id_category'],$_POST['titre']);

$Service=new CategoryController();

$prod=$Service->ModifierCategory($category);

header('location:mycategory.php');




?>