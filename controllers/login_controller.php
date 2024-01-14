<?php
if (isset($_POST['login']))
{
    $user = new User();

    $result = $user->login($_POST['email'], $_POST['password']);

    if ($result) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['full_name'] = $user->first_name . ' ' . $user->last_name;
        if ($user->role == 'admin')
        {
            header("Location:" . "index.php?page=admin");
        } else {
            header("Location:" . "index.php?page=home");
        }
    } else {
        header("Location:" . "index.php?page=login");
    }
}

if (isset($_POST['logout']))
{
    session_destroy();
}
