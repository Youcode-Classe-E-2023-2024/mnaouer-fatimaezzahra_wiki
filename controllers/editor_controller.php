<?php

$tags = Tag::getAll();
$categories = Category::getAll();

if (isset($_GET['id'])) {
    $article = Article::getArticle($_GET['id']);

    if ($article['tags']) {
        $tags_article = explode(',', strtolower($article['tags']));
    } else {
        $tags_article = [];
    }
}

if (isset($_POST['edit'])) {
    extract($_POST);

    $result = Article::editArticle(
        $id,
        str_secure($title),
        str_secure($content),
        $category,
        $tags);

    if($result) {
        header('Location: index.php?page=article&id=' . $_POST['id']);
    } else {
        header('Location: index.php?page=editor');
    }
}

if (isset($_POST['create'])) {
    extract($_POST);

    $result = Article::createArticle(
        str_secure($title),
        str_secure($content),
        $_SESSION['user_id'],
        $category,
        $tags);

    if($result) {
        header('Location: index.php?page=article&id=' . $result);
    } else {
        header('Location: index.php?page=editor');
    }
}