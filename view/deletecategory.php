<?php
include '../Controller/ProductController.php';
$categoryc = new CategoryController();

// récupérer l'id passé dans l'URL en utilisant la methode par défaut $_GET["id"]
$categoryc->deleteCategory($_GET["id_category"]);
//une fois la suppression est faite une redirection vers la liste des produits ce fait
header('Location:mycategory.php');

?>
