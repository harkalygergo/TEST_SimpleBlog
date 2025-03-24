<?php

namespace App;

use Cocur\Slugify\Slugify;
use PDO;
use PDOException;

class Database
{
    private ?string $host;
    private ?string $name;
    private ?string $username;
    private ?string $password;
    private ?PDO $connection;

    public function __construct()
    {
        $this->initDatabaseConfig();
    }

    private function initDatabaseConfig()
    {
        $this->host = $_ENV['DATABASE_HOST'];
        $this->name = $_ENV['DATABASE_NAME'];
        $this->username = $_ENV['DATABASE_USER'];
        $this->password = $_ENV['DATABASE_PASSWORD'];
    }

    public function connection(): ?PDO
    {
        $this->connection = null;

        try {
            $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->name, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->connection;
    }

    public function createTables()
    {
        $this->connection()->exec("
            CREATE TABLE IF NOT EXISTS users (
                id          INT AUTO_INCREMENT PRIMARY KEY,
                email       VARCHAR(255) NOT NULL UNIQUE,
                password    VARCHAR(255) NOT NULL,
                is_active   TINYINT DEFAULT 1
            );
            CREATE TABLE IF NOT EXISTS posts (
                id              INT AUTO_INCREMENT PRIMARY KEY,
                user_id         INT NOT NULL,
                title           VARCHAR(255) NOT NULL,
                slug            VARCHAR(255) NOT NULL,
                content         TEXT NOT NULL,
                created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at      DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                published_at    DATETIME DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            );
        ");
    }

    public function destroyTables()
    {
        $this->connection()->exec("
            DROP TABLE IF EXISTS posts;
            DROP TABLE IF EXISTS users;
        ");
    }

    public function closeConnection()
    {
        $this->connection = null;
    }

    public function __destruct()
    {
        $this->closeConnection();
    }

    public function loadDemoData()
    {
        $slugify = new Slugify();

        // empty users and posts tables
        $this->connection()->exec("
            SET FOREIGN_KEY_CHECKS = 0;
            TRUNCATE users;
            TRUNCATE posts;
            SET FOREIGN_KEY_CHECKS = 1;
        ");

        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $users[] = [
                'email' => 'user' . $i . '@localhost.tld',
                'password' => password_hash('123456', PASSWORD_DEFAULT)
            ];
        }

        $posts = [];
        for ($i = 0; $i < 10; $i++) {
            $title = 'Post ' . $i. ' '. bin2hex(random_bytes(8));
            $posts[] = [
                'user_id' => rand(1, 10),
                'title' => $title,
                'slug' => $slugify->slugify($title),
                'content' => bin2hex(random_bytes(50)). ' '. bin2hex(random_bytes(50)). ' '. bin2hex(random_bytes(50)). ' '. bin2hex(random_bytes(50)),
                'publish_at' => date('Y-m-d H:i:s', strtotime('+' . $i . ' days'))
            ];
        }

        foreach ($users as $user) {
            $this->connection()->exec("
                INSERT INTO users (email, password) VALUES ('{$user['email']}', '{$user['password']}');
            ");
        }

        foreach ($posts as $post) {
            $this->connection()->exec("
                INSERT INTO posts (user_id, title, slug, content, publish_at) VALUES ('{$post['user_id']}', '{$post['title']}','{$post['slug']}', '{$post['content']}', '{$post['publish_at']}');
            ");
        }

    }
}
