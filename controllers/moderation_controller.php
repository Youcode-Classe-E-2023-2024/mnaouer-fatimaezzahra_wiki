<?php

admin_secure();

$articles = Article::getAll();

if(isset($_POST["archive"])){
    $result = Article::archiveArticle($_POST['id']);

    if ($result) {
        header('Location: index.php?page=moderation');
    } else {
        header('Location: index.php?page=article&id=' . $_GET['id']);
    }
}