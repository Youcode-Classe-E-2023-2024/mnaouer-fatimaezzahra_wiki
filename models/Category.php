<?php

class Category
{
    static function getAll()
    {
        global $db;
        $result = $db->query("SELECT * FROM categories 
         ORDER BY create_at DESC, edit_at;");

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}