<?php

class Tag
{
    private $id;
    public $name;
  
    static function getAll()
    {
        global $db;
        $result = $db->query("SELECT * FROM tags;");
  
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTag($tagName)
    {
        global $db;

        $stmt = $db->prepare("INSERT INTO tags (name) VALUES (?);");
        $stmt->bindValue(bindParam1, $tagName);

        return $stmt->execute();
    }
}
