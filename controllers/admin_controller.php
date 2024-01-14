<?php

include_once 'models/Category.php';
$category = new Category();

$categories = $category ->AllCategory();
