<?php

spl_autoload_register(function ($className){
    require_once ('../app/libraries/'.$className.'.php');
});

spl_autoload_register(function ($className){
    require_once ('../app/helpers'.$className.'.php');
});

require_once('../app/config/config.php');


