<?php

namespace App;

use App\Controller\HomepageController;

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

        // call HomepageController and its method index
        $homepageController = new HomepageController();
        $homepageController->index();
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
