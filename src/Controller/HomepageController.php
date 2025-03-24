<?php

namespace App\Controller;

use App\Model\PostModel;
use Smarty\Smarty;

class HomepageController
{
    public function index(): void
    {
        $postModel = new PostModel();
        $posts = $postModel->getAllPostsWithAuthors();

        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../../templates/frontend');
        $smarty->setCompileDir(__DIR__ . '/../../var/smarty/compile');
        $smarty->setCacheDir(__DIR__ . '/../../var/smarty/cache');
        $smarty->setConfigDir(__DIR__ . '/../../var/smarty/config');

        $smarty->assign('posts', $posts);
        $smarty->display('homepage.tpl');
    }
}