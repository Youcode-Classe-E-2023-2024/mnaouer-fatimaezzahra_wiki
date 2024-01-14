<?php

    // Assurez-vous que le champ 'name' est présent dans la requête
    if (isset($_POST["name"])&& !empty($_POST['name'])) {
        // Récupérez la valeur du champ 'name'
        $categoryName = $_POST["name"];

        include_once 'models/Category.php';
        $category = new Category();

        $result = $category->addCategory($categoryName);

        // Exemple : affichez le nom de la catégorie
        echo "Category Name: " . $categoryName;
    }


include_once 'models/Category.php';
$category = new Category();

$categories = $category->AllCategory();

if (isset($_POST["delete"])&& !empty($_POST['id']))
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
if (isset($_POST["edit"])&& !empty($_POST['id']) && !empty($_POST['name']))
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



