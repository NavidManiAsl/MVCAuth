<?php

spl_autoload_register(function ($className){
    require_once ('../app/libraries/'.$className.'.php');
});

require_once('../app/config/config.php');

// require_once( '../app/libraries/Controller.php');
// require_once( '../app/libraries/Core.php');
// require_once('../app/libraries/Database.php');