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

