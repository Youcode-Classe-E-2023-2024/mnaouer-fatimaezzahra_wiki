<?php

class Article
{
    static function countArticles()
    {
        global $db;

        $result = $db->query('SELECT count(*) AS count FROM articles;');
        $articles_count = $result->fetch();

        return $articles_count['count'];
    }

    static function getAll()
    {
        global $db;
        $result = $db->query("SELECT articles.*, categories.name FROM articles
         JOIN categories on categories.id = articles.id_category
         WHERE status != 'archived' 
         ORDER BY articles.create_at DESC, articles.edit_at;");

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    static function searchArticles($searchKey)
    {
        global $db;
        $stmt = $db->prepare("SELECT DISTINCT a.*, c.name
            FROM (SELECT * FROM articles WHERE status != 'archived' ORDER BY create_at DESC, edit_at) a
                     LEFT JOIN categories c ON a.id_category = c.id
                     LEFT JOIN articles_tags at ON a.id = at.id_article
                     LEFT JOIN tags t ON at.id_tag = t.id
            WHERE a.title LIKE ?
               OR c.name LIKE ?
               OR t.name LIKE ?;
        ");
        $searchKey = '%' . $searchKey . '%';
        $stmt->bindParam(1, $searchKey);
        $stmt->bindParam(2, $searchKey);
        $stmt->bindParam(3, $searchKey);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static function getArticle($id)
    {
        global $db;

        $stmt = $db->prepare("SELECT articles.id, title, content, articles.create_at, first_name, last_name, categories.name, GROUP_CONCAT(tags.name) AS tags, users.id owner_id
            from articles
                     JOIN users ON users.id = articles.id_user
                     JOIN categories ON categories.id = articles.id_category
                     LEFT JOIN articles_tags ON articles.id = articles_tags.id_article
                     LEFT JOIN tags ON tags.id = articles_tags.id_tag
            WHERE articles.id = ?;
        ");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static function getLastArticles()
    {
        global $db;

        $stmt = $db->prepare("SELECT * FROM articles
         WHERE status != 'archived' 
         ORDER BY articles.create_at DESC, articles.edit_at LIMIT 5;
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static function getArticlesOwner($owner_id)
    {
        global $db;

        $stmt = $db->prepare("SELECT a.*, c.name
            FROM users u
                     JOIN articles a on u.id = a.id_user
                     JOIN categories c on c.id = a.id_category
            WHERE u.id = ?
              AND a.status != 'archived';");

        $stmt->bindParam(1, $owner_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static function createArticle($title, $content, $id_user, $id_category, $tags)
    {
        global $db;

        $stmt = $db->prepare("INSERT INTO articles (title, content, id_user, id_category) VALUES (?, ?, ?, ?);");

        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $content);
        $stmt->bindParam(3, $id_user, PDO::PARAM_INT);
        $stmt->bindParam(4, $id_category, PDO::PARAM_INT);
        $stmt->execute();

        $id = $db->lastInsertId();

        if ($id) {
            if (isset($tags) && !empty($tags)) {
                foreach ($tags as $tag_id) {
                    $stmt = $db->prepare("INSERT INTO articles_tags (id_article, id_tag) VALUES (?, ?);");
                    $stmt->bindParam(1, $id, PDO::PARAM_INT);
                    $stmt->bindParam(2, $tag_id, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }

            return $id;
        }

        return false;
    }

    static function editArticle($id, $title, $content, $id_category, $tags)
    {
        global $db;

        $stmt = $db->prepare("UPDATE articles
                    SET title = ?, content = ?, id_category = ?, edit_at = NOW()
                    WHERE id = ?;");

        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $content);
        $stmt->bindParam(3, $id_category, PDO::PARAM_INT);
        $stmt->bindParam(4, $id, PDO::PARAM_INT);
        $result = $stmt->execute();

        if ($result) {
            $stmt = $db->prepare("DELETE FROM articles_tags WHERE id_article = ?;");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();

            if (isset($tags) && !empty($tags)) {
                foreach ($tags as $tag_id) {
                    $stmt = $db->prepare("INSERT INTO articles_tags (id_article, id_tag) VALUES (?, ?);");
                    $stmt->bindParam(1, $id, PDO::PARAM_INT);
                    $stmt->bindParam(2, $tag_id, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }

            return true;
        }

        return false;
    }

    static function deleteArticle($id)
    {
        global $db;

        $stmt = $db->prepare("DELETE FROM articles WHERE id = ?;");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    static function archiveArticle($id)
    {
        global $db;

        $stmt = $db->prepare("UPDATE articles
                    SET status = 'archived' WHERE id = ?;");
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }
}


