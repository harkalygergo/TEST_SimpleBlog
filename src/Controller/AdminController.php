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
                    switch ($_GET['type']) {
                        case 'user':
                            (new UserModel())->edit();
                            break;
                        case 'post':
                            (new PostModel())->edit();
                            break;
                    }
                    break;
                case 'delete':
                    switch($_GET['type']) {
                        case 'user':
                            (new UserModel())->delete($_GET['id']);
                            break;
                        case 'post':
                            (new PostModel())->delete($_GET['id']);
                            break;
                    }
                    header('Location: /admin');
                    break;
                case 'create':
                    switch ($_GET['type']) {
                        case 'user':
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                $userModel = new UserModel();
                                $userModel->create($_POST);
                                header('Location: /admin');
                            } else {
                                $smarty = new Smarty();
                                $smarty->setTemplateDir(__DIR__ . '/../../templates/backend');
                                $smarty->setCompileDir(__DIR__ . '/../../var/smarty/compile');
                                $smarty->setCacheDir(__DIR__ . '/../../var/smarty/cache');
                                $smarty->setConfigDir(__DIR__ . '/../../var/smarty/config');

                                $smarty->assign('title', 'Felhasználó létrehozása');
                                $smarty->display('user/create.tpl');
                            }
                            break;
                        case 'post':
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
                    }
                    break;
                case 'update':
                    // update post with posted data
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        switch ($_GET['type']) {
                            case 'user':
                                $userModel = new UserModel();
                                $userModel->update($_GET['id'], $_POST);
                                break;
                            case 'post':
                                $postModel = new PostModel();
                                $postModel->update($_GET['id'], $_POST);
                                break;
                        }
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
        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../../templates/backend');
        $smarty->setCompileDir(__DIR__ . '/../../var/smarty/compile');
        $smarty->setCacheDir(__DIR__ . '/../../var/smarty/cache');
        $smarty->setConfigDir(__DIR__ . '/../../var/smarty/config');

        $smarty->assign('title', 'Bejegyzések és felhasználók');
        $smarty->assign('posts', (new PostModel())->getAllPostsWithAuthors());
        $smarty->assign('users', (new UserModel())->getAll());
        $smarty->display('admin.tpl');
    }

}