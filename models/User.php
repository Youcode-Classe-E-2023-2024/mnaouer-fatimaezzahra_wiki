<?php


class User
{
    public $id;
    public $first_name;
    public $last_name;
    public $role;

    function register($first_name, $last_name, $email, $password)
    {
        global $db;

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Utilisez une requête préparée pour éviter les problèmes de sécurité liés à l'injection SQL.
        $stmt = $db->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?);");
        $stmt->bindParam(1, $first_name);
        $stmt->bindParam(2, $last_name);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $password_hash);

        return $stmt->execute();
    }

    function login($email, $password)
    {
        global $db;

        // Utilisez une requête préparée pour éviter les problèmes de sécurité liés à l'injection SQL.
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bindParam(1, $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->id = $user['id'];
                $this->first_name = $user['first_name'];
                $this->last_name = $user['last_name'];
                $this->role = $user['role'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    static function getUser($id)
    {
        global $db;

        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
