<?php

$categories = Category::getAll();

$last_articles = Article::getLastArticles();

if (isset($_POST['delete'])) {
    $result = Article::deleteArticle($_POST['id']);

    if ($result) {
        header('Location: index.php?page=home');
    }
}

if (isset($_GET['id'])) {
    $article = Article::getArticle($_GET['id']);

    $full_name = $article['first_name'] . ' ' . $article['last_name'];

    $date = date('M d, Y', strtotime($article['create_at']));

    if ($article['tags']) {
        $tags = explode(',', strtolower($article['tags']));
    } else {
        $tags = [];
    }
} else {
    die('404');
}
