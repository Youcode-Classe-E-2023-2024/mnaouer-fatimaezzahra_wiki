<?php

class Tag
{
    private $id;
    public $name;

    public function addTag($tagName)
    {
        global $db;

        $stmt = $db->prepare("INSERT INTO tags (name) VALUES (?);");
        $stmt->bindValue(bindParam1, $tagName);

        return $stmt->execute();
    }

}