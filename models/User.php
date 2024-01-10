<?php


class User
{
private $id;
public $first_name;
public $last_name;
public $email;
private $password;

function select_users()
{
global $db;
$result = $db->query("SELECT * FROM users;");
return $result->fetchAll(PDO::FETCH_ASSOC);
}

function register($first_name, $last_name, $email, $password)
{
global $db;

// Utilisez une requête préparée pour éviter les problèmes de sécurité liés à l'injection SQL.
$stmt = $db->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?);");
$stmt->bindParam(1, $first_name);
$stmt->bindParam(2, $last_name);
$stmt->bindParam(3, $email);
$stmt->bindParam(4, $password);

return $stmt->execute();
}

function login($email, $password)
{
global $db;

// Utilisez une requête préparée pour éviter les problèmes de sécurité liés à l'injection SQL.
$stmt = $db->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
$stmt->bindParam(1, $email);
$stmt->bindParam(2, $password);
$stmt->execute();

return $stmt->fetch(PDO::FETCH_ASSOC);
}
}
