<?php

spl_autoload_register(function ($className) {

    if (file_exists('../app/libraries/' . $className . '.php')) {
        require_once('../app/libraries/' . $className . '.php');
    } else {
        require_once('../app/helpers/' . $className . '.php');
    }
});

require_once('../app/config/config.php');
require_once('../app/helpers/helper.php');

