<?php
if (isset($_POST['register'])) {
    $user = new User();
    extract($_POST);

    $result = $user->register(
        str_secure($first_name),
        str_secure($last_name),
        str_secure($email),
        str_secure($password));

    if ($result) {
        header("Location:" . "index.php?page=login");
    } else {
        header("Location:" . "index.php?page=register");
    }
}
