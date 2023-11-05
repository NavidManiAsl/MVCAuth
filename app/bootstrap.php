<?php
// App\Libraries\Core
spl_autoload_register(function ($className) {

 $class = str_replace("\\","/", $className);
 
 if(file_exists('../'.$class.'.php')) {
    require_once('../'.$class.'.php');
}
});
require_once('../app/config/config.php');
require_once('../app/helpers/helper.php');

