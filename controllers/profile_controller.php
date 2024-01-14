<?php

$id = $_SESSION['user_id'];

$categories = Category::getAll();

$articles = Article::getArticlesOwner($id);

$profile = User::getUser($id);
