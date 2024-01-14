<?php

class category
{
    private $id;
    public $name;
    public $create_at;
    public $edit_at;

    static function countCategories()
    {
        global $db;

        $result = $db->query('SELECT count(*) AS count FROM categories;');
        $categorie_count = $result->fetch();

        return $categorie_count['count'];
    }

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

    public function deleteCategory($id)
    {
        global $db;

        $stmt = $db->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function editCategory($id, $name)
    {
        global $db;

        $stmt = $db->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}