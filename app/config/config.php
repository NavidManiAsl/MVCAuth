<?php

define("APP_ROOT", dirname(dirname(__FILE__))); //is the directory address where your application files are located.
define('PROJECT_NAME', 'MVC-Auth');
define('LOGS',dirname(dirname(__FILE__)).'\..\logs\\'); // is the directory address where your logs will be stored.
define("SESSION_LIFE_SPAN",1800);



$envFile = APP_ROOT . "/.env";
if (file_exists($envFile)) {
    $dotenv = parse_ini_file($envFile);
} else {
    die('.env file not found');
}

define('URI', $dotenv["BASE_URL"]);
//DB credentials
define("DB_USER", $dotenv["DB_USER"]);
define("DB_PASSWORD", $dotenv["DB_PASSWORD"]);
define("DB_HOST", $dotenv["DB_HOST"]);
define("DB_NAME", $dotenv["DB_NAME"]);


