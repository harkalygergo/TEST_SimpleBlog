<?php

namespace App;

use App\Controller\HomepageController;
use App\Model\BaseModel;
use Smarty\Smarty;

class App
{
    private ?Database $database;

    public function __construct()
    {
        new Config();
        $this->database = new Database();

        $this->debug();

        if (isset($_GET['createDatabase'])) {
            $this->database->createDatabase();
        }

        if (isset($_GET['loadDemoData'])) {
            $this->database->loadDemoData();
        }

        if (!isset($_GET['url'])) {
            $homepageController = new HomepageController();
            $homepageController->index();
        } else {
            $baseModel = new BaseModel();
            $baseModel->setTable('posts');
            $post = $baseModel->findBySlug($_GET['url']);

            $smarty = new Smarty();
            $smarty->setTemplateDir(__DIR__ . '/templates/frontend');
            $smarty->setCompileDir(__DIR__ . '/var/smarty/compile');
            $smarty->setCacheDir(__DIR__ . '/var/smarty/cache');
            $smarty->setConfigDir(__DIR__ . '/var/smarty/config');

            $smarty->assign('post', $post);
            $smarty->display('frontend/post.tpl');
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
}
