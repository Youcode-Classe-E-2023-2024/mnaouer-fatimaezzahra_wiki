<?php

// Assurez-vous que le champ 'name' est présent dans la requête
if (isset($_POST["name"])&& !empty($_POST['name'])) {
    // Récupérez la valeur du champ 'name'
    $tagName = $_POST["name"];
//echo ($_POST["name"]);
    include_once 'models/Tag.php';
    $tag = new Tag();

    $result = $tag->addTag($tagName);

    // Exemple : affichez le nom de la tag
    echo "Tag Name: " . $tagName;
}

