<?php

include_once 'config.php';

if (isset($_GET['page']))
{
    include_once 'controllers/' . $_GET['page'] . '_controller.php';
    include_once 'views/' . $_GET['page'] . '_view.php';
} else {
    include_once 'controllers/home_controller.php';
    include_once 'views/home_view.php';
}
