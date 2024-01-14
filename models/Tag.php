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
        $stmt->bindValue(1, $tagName);

        return $stmt->execute();
    }

    function AllTags()
    {
        global $db;

        $stmt = $db->query("SELECT * FROM tags");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteTags($id)
    {
        global $db;

        $stmt = $db->prepare("DELETE FROM tags WHERE id = ?");
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }

    public function editTag($id, $name)
    {
        global $db;

        $stmt = $db->prepare("UPDATE tags SET name = ? WHERE id = ?");
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $id);
        return $stmt->execute();
    }
}
