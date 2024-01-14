<?php

class Tag
{
    static function getAll()
    {
        global $db;
        $result = $db->query("SELECT * FROM tags;");

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
