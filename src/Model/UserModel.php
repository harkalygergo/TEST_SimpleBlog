<?php

namespace App\Model;

use PDO;
use Smarty\Smarty;

class UserModel extends BaseModel
{
    protected $table = 'users';

    public function edit()
    {
        $user = $this->findById($_GET['id']);

        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../../templates/backend');
        $smarty->setCompileDir(__DIR__ . '/../../var/smarty/compile');
        $smarty->setCacheDir(__DIR__ . '/../../var/smarty/cache');
        $smarty->setConfigDir(__DIR__ . '/../../var/smarty/config');

        $smarty->assign('user', $user);
        $smarty->display('user/edit.tpl');
    }

    public function create($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (email, password, is_active) 
            VALUES (:email, :password, :is_active)
        ");

        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':is_active', $data['is_active'], PDO::PARAM_INT);
        $stmt->execute();

        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        if ($data['password'] !== '') {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("
                UPDATE {$this->table} 
                SET password = :password
                WHERE id = :id
            ");
            $stmt->bindParam(':password', $data['password']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }

        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET email = :email, is_active = :is_active
            WHERE id = :id
        ");

        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':is_active', $data['is_active'], PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function findByEmailAndPassword($email, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch();

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        return $user;
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}