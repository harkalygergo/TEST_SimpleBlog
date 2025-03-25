<?php

namespace App\Controller;

use App\Model\PostModel;
use Smarty\Smarty;

class PostController
{
    public function __construct()
    {
        $postModel = new PostModel();
        $post = $postModel->findBySlug($_GET['url']);

        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../templates/frontend');
        $smarty->setCompileDir(__DIR__ . '/../var/smarty/compile');
        $smarty->setCacheDir(__DIR__ . '/../var/smarty/cache');
        $smarty->setConfigDir(__DIR__ . '/../var/smarty/config');

        $smarty->assign('post', $post);
        $smarty->assign('posts', (new PostModel())->getAllPostsWithAuthors());
        $smarty->display('post.tpl');
    }
}