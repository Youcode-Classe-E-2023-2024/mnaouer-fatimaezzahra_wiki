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


include_once 'models/Tag.php';
$tag = new Tag();

$tags = $tag ->AllTags();

if (isset($_POST["delete"])&& !empty($_POST['id']))
{
    $id = $_POST['id'];

    if($tag ->deleteTags($id))
    {
        header("Location:" . "index.php?page=tag");
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

    if($tag ->editTag($id, $name))
    {
        header("Location:" . "index.php?page=tag");
    }else
    {
        header("Location:" . "index.php?page=admin&STATUS=error");
    }
}

