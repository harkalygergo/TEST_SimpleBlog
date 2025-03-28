<?php
namespace App\Model;

use PDO;
use Smarty\Smarty;

class PostModel extends BaseModel
{
    protected $table = 'posts';

    public function edit()
    {
        $post = $this->getPostWithAuthor($_GET['id']);

        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../../templates/backend');
        $smarty->setCompileDir(__DIR__ . '/../../var/smarty/compile');
        $smarty->setCacheDir(__DIR__ . '/../../var/smarty/cache');
        $smarty->setConfigDir(__DIR__ . '/../../var/smarty/config');

        $smarty->assign('post', $post);
        $smarty->display('edit.tpl');
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (title, slug, content, user_id, created_at) 
            VALUES (:title, :slug, :content, :user_id, NOW())
        ");

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':slug', $data['slug']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);
        $stmt->execute();

        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET title = :title, content = :content, updated_at = NOW()
            WHERE id = :id
        ");

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getPublishedPosts()
    {
        $stmt = $this->db->prepare("
            SELECT p.*, u.username as author
            FROM {$this->table} p
            JOIN users u ON p.user_id = u.id
            WHERE p.is_published = 1
            ORDER BY p.created_at DESC
        ");

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPostWithAuthor($id)
    {
        $stmt = $this->db->prepare("
            SELECT p.*, u.email as author
            FROM {$this->table} p
            JOIN users u ON p.user_id = u.id
            WHERE p.id = :id
        ");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getAllPostsWithAuthors()
    {
        $stmt = $this->db->prepare("
            SELECT p.*, u.email as author
            FROM {$this->table} p
            JOIN users u ON p.user_id = u.id
            ORDER BY p.published_at DESC
        ");

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findBySlug(string $slug)
    {
        $stmt = $this->db->prepare("
            SELECT p.*, u.email as author
            FROM {$this->table} p 
            JOIN users u ON p.user_id = u.id
            WHERE slug = :slug
        ");
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }

}