<?php 
use App\Libraries\Core;


require_once('../app/bootstrap.php');


session_set_cookie_params(SESSION_LIFE_SPAN);
session_start();

$app = new Core();
?>