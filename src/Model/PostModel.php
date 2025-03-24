<?php
namespace App\Model;

use PDO;

class PostModel extends BaseModel
{
    protected $table = 'posts';

    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (title, content, user_id, is_published, created_at) 
            VALUES (:title, :content, :user_id, :is_published, NOW())
        ");

        $isPublished = isset($data['is_published']) ? 1 : 0;

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);
        $stmt->bindParam(':is_published', $isPublished, PDO::PARAM_INT);

        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET title = :title, content = :content, is_published = :is_published, updated_at = NOW()
            WHERE id = :id
        ");

        $isPublished = isset($data['is_published']) ? 1 : 0;

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':is_published', $isPublished, PDO::PARAM_INT);
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
            SELECT p.*, u.username as author
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
            ORDER BY p.publish_at DESC
        ");

        $stmt->execute();
        return $stmt->fetchAll();
    }
}