<?php

admin_secure();

$users_count = User::countUsers();
$articles_count = Article::countArticles();
$categories_count = Category::countCategories();
$tags_count = Tag::countTags();
