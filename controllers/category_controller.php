<?php

include_once 'models/Category.php';
$category = new Category();

$categories = $category->AllCategory();

// Assurez-vous que le champ 'name' est présent dans la requête
if (isset($_POST["create"])) {
    // Récupérez la valeur du champ 'name'
    $categoryName = $_POST["name"];

    if($category->addCategory($categoryName))
    {
        header("Location:" . "index.php?page=category");
    }else
    {
        header("Location:" . "index.php?page=admin&STATUS=error");
    }
}

if (isset($_POST["delete"]))
{
    $id = $_POST['id'];

    if($category->deleteCategory($id))
    {
        header("Location:" . "index.php?page=category");
    }else
    {
        header("Location:" . "index.php?page=admin&STATUS=error");
    }
}
//on verifier si on a clicker sur le boutton
if (isset($_POST["edit"]))
{
    $id = $_POST['id'];
    $name = $_POST['name'];

    if($category ->editCategory($id, $name))
    {
        header("Location:" . "index.php?page=category");
    }else
    {
        header("Location:" . "index.php?page=admin&STATUS=error");
    }
}



