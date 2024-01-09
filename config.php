<?php

function dd($var)
{
    echo '<pre>';
    echo '<code>';
    print_r($var);
    echo '</code>';
    echo '</pre>';
}

$dsn = 'mysql:host=localhost;dbname=wiki_db';
$username = 'root';
$password = '';

//cette etape est faite pour afficher le message d'errer lors de non connection du base données
try {
    $db = new PDO($dsn, $username, $password);
} catch (Exception $e) {
    echo $e->getMessage();
}

$result = $db->query("SELECT * FROM users");

//importe la data ligne par ligne
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    // Utilisez les données comme nécessaire
    echo $row['first_name'] . ' ' . $row['last_name'] . ' ' . $row['role'] . '<br>';
}
