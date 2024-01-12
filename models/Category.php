<?php

class category
{
    private $id;
    public $name;
    public $create_at;
    public $edit_at;


    public function addCategory($categoryName)
    {
        global $db;

        $stmt = $db->prepare("INSERT INTO categories (name) VALUES (?);");
        $stmt->bindValue(1, $categoryName);

        return $stmt->execute();
    }


    function AllCategory()
    {
        global $db;

        $stmt = $db->query("SELECT * FROM categories");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}