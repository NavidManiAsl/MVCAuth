<?php

define("APP_ROOT", dirname(dirname(__FILE__)));
define('URI', 'http://localhost:81/mvc/');
define('PROJECT_NAME', 'MVC-Framework');


//DB credentials

$envFile = APP_ROOT . "/.env";
if (file_exists($envFile)) {
    $dotenv = parse_ini_file($envFile);
} else {
    die('.env file not found');
}

define("DB_USER", $dotenv["DB_USER"]);
define("DB_PASSWORD", $dotenv["DB_PASSWORD"]);
define("DB_HOST", $dotenv["DB_HOST"]);
define("DB_NAME", $dotenv["DB_NAME"]);
define("SESSION_LIFE_SPAN",1800);


