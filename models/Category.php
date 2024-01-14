<?php

class category
{
    private $id;
    public $name;
    public $create_at;
    public $edit_at;
  
    static function getAll()
    {
        global $db;
        $result = $db->query("SELECT * FROM categories 
         ORDER BY create_at DESC, edit_at;");

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

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