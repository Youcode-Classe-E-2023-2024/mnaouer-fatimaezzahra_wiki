<?php
session_start();

/**
 * Pour debuger.
 * @param $var
 * @return void
 */
function dd($var)
{
    echo '<pre>';
    echo '<code>';
    var_dump($var);
    echo '</code>';
    echo '</pre>';
    die();
}

/**
 * Securisation d'une chaine de caractere contre la faille XSS
 * @param [type] $string
 * @return string
 */
function str_secure($string){
    return trim(htmlspecialchars($string));
}

const DSN = 'mysql:host=localhost;dbname=wiki_db';
const USERNAME = 'root';
const PASSWORD = '';

try {
    $db = new PDO(DSN, USERNAME, PASSWORD);
} catch (Exception $e) {
    echo $e->getMessage();
}
