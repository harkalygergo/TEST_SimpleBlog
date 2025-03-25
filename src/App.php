<?php

namespace App;

use App\Controller\AdminController;
use App\Controller\HomepageController;
use App\Controller\PostController;
use Smarty\Smarty;

class App
{
    private ?Database $database;

    public function __construct()
    {
        new Config();
        $this->database = new Database();

        $this->debug();

        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'login':
                    $this->login();
                    break;
                case 'destroyTables':
                    $this->database->destroyTables();
                    break;
                case 'createTables':
                    $this->database->createTables();
                    break;
                case 'loadDemoData':
                    $this->database->loadDemoData();
                    break;
            }
        }

        if (!isset($_GET['url'])) {
            $homepageController = new HomepageController();
            $homepageController->index();
        } else {

            if ($_GET['url'] === 'admin') {
                new AdminController();
            } else {
                new PostController();
            }
        }

    }

    public function debug()
    {
        if ($_ENV['APP_DEBUG'] === 'true') {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['username'] === 'admin' && $_POST['password'] === 'admin') {
                $_SESSION['user'] = 'admin';
                header('Location: /admin');

            } else {
                echo 'Hibás felhasználónév vagy jelszó!';
            }

        } else {
            $smarty = new Smarty();
            $smarty->setTemplateDir(__DIR__ . '/../../templates/backend');
            $smarty->setCompileDir(__DIR__ . '/../../var/smarty/compile');
            $smarty->setCacheDir(__DIR__ . '/../../var/smarty/cache');
            $smarty->setConfigDir(__DIR__ . '/../../var/smarty/config');

            $smarty->display('login.tpl');
        }
    }
}
