<?php
if (isset ($_POST['first_name']) && !empty($_POST['first_name']) && ($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']))


//if ($_SERVER['REQUEST_METHOD'] === 'POST')
{

    // Instantier la classe utilisateur
    include_once 'models/User.php';
    $user = new User();


    $result = $user->register($_POST['first_name'],$_POST['last_name'],$_POST['email'], $_POST['password']);

    if ($result) {
        header("Location:" . "index.php?page=login");
    } else {
        header("Location:" . "index.php?page=register");
    }
}
