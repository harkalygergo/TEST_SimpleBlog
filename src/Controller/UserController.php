<?php

namespace App\Controller;

use App\Model\UserModel;
use Smarty\Smarty;

class UserController
{
    // create function to show edit.tpl form
    public function edit(): void
    {
        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../../templates/backend');
        $smarty->setCompileDir(__DIR__ . '/../../var/smarty/compile');
        $smarty->setCacheDir(__DIR__ . '/../../var/smarty/cache');
        $smarty->setConfigDir(__DIR__ . '/../../var/smarty/config');

        $smarty->display('edit.tpl');
    }

    public function login(): void
    {
        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../../templates/frontend');
        $smarty->setCompileDir(__DIR__ . '/../../var/smarty/compile');
        $smarty->setCacheDir(__DIR__ . '/../../var/smarty/cache');
        $smarty->setConfigDir(__DIR__ . '/../../var/smarty/config');

        $smarty->display('login.tpl');
    }

    public function loginPost(): void
    {
        $userModel = new UserModel();
        $user = $userModel->findByEmailAndPassword($_POST['email'], $_POST['password']);

        if ($user) {
            $_SESSION['user'] = $user;
            header('Location: /');
        } else {
            header('Location: /login');
        }
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: /');
    }
}