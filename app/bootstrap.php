<?php

spl_autoload_register(function ($className){
    require_once ('../app/libraries/'.$className.'.php');
});

require_once('../app/config/config.php');
require_once('../app/validation/Validator.php');
require_once('../app/helpers/helper.php');

