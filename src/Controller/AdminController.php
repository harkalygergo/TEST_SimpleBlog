<?php

namespace App\Controller;

use App\Model\PostModel;
use Smarty\Smarty;

class AdminController
{
    public function index(): void
    {
        $postModel = new PostModel();
        $posts = $postModel->getAllPostsWithAuthors();

        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../../templates/admin');
        $smarty->setCompileDir(__DIR__ . '/../../var/smarty/compile');
        $smarty->setCacheDir(__DIR__ . '/../../var/smarty/cache');
        $smarty->setConfigDir(__DIR__ . '/../../var/smarty/config');

        $smarty->assign('posts', $posts);
        $smarty->display('admin.tpl');
    }
}