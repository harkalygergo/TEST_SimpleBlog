<?php

namespace App\Controller;

use App\Model\PostModel;
use App\Model\UserModel;
use Smarty\Smarty;

class AdminController
{
    public function __construct()
    {
        /*
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            exit;
        }
        */

        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'logout':
                    session_destroy();
                    header('Location: /');
                    break;
                case 'edit':
                    $postModel = new PostModel();
                    $post = $postModel->getPostWithAuthor($_GET['id']);

                    $smarty = new Smarty();
                    $smarty->setTemplateDir(__DIR__ . '/../../templates/backend');
                    $smarty->setCompileDir(__DIR__ . '/../../var/smarty/compile');
                    $smarty->setCacheDir(__DIR__ . '/../../var/smarty/cache');
                    $smarty->setConfigDir(__DIR__ . '/../../var/smarty/config');

                    $smarty->assign('post', $post);
                    $smarty->display('edit.tpl');
                    break;
                case 'delete':
                    $postModel = new PostModel();
                    $postModel->delete($_GET['id']);
                    header('Location: /admin');
                    break;
                case 'create':
                    // add new post with posted data
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $postModel = new PostModel();
                        $postModel->create($_POST);
                        header('Location: /admin');
                    } else {
                        $smarty = new Smarty();
                        $smarty->setTemplateDir(__DIR__ . '/../../templates/backend');
                        $smarty->setCompileDir(__DIR__ . '/../../var/smarty/compile');
                        $smarty->setCacheDir(__DIR__ . '/../../var/smarty/cache');
                        $smarty->setConfigDir(__DIR__ . '/../../var/smarty/config');

                        $users = (new UserModel())->getAll();

                        $smarty->assign('title', 'Bejegyzés létrehozása');
                        $smarty->assign('users', $users);
                        $smarty->display('new.tpl');
                    }
                    break;
                case 'update':
                    // update post with posted data
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $postModel = new PostModel();
                        $postModel->update($_POST['id'], $_POST);
                        header('Location: /admin');
                    } else {
                        $this->index();
                    }
            }
        } else {
            $this->index();
        }
    }

    public function index(): void
    {
        $postModel = new PostModel();
        $posts = $postModel->getAllPostsWithAuthors();

        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../../templates/backend');
        $smarty->setCompileDir(__DIR__ . '/../../var/smarty/compile');
        $smarty->setCacheDir(__DIR__ . '/../../var/smarty/cache');
        $smarty->setConfigDir(__DIR__ . '/../../var/smarty/config');

        $smarty->assign('posts', $posts);
        $smarty->assign('title', 'Bejegyzések');
        $smarty->display('admin.tpl');
    }

}