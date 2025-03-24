<?php

namespace App;

class Config
{
    public function __construct()
    {
        $dotenv = file_get_contents(__DIR__ . "/../.env");
        $dotenv = explode("\n", $dotenv);
        foreach ($dotenv as $line) {
            if (empty($line)) {
                continue;
            }
            $line = explode("=", $line);
            $_ENV[$line[0]] = $line[1];
        }
    }
}