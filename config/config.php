<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Dotenv\Dotenv;

//Loading the environment variable
$env_path = __DIR__ . "//../";
$dotenv = Dotenv::createImmutable($env_path);
$dotenv->load();

