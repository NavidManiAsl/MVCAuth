<?php
namespace App\Libraries;
class Controller
{

    protected function model($model , $dependencies = null)
    {
        $model = ucfirst($model);
        if (file_exists(APP_ROOT.'/models/' . ucfirst($model) . '.php')) {
           
            require_once(APP_ROOT . '/models/' . ucfirst($model) . '.php');
                
                $class = 'App\\Models\\' . $model;
                return new $class($dependencies);
            
        }else{ }
    }

    protected function view($view,$data=[])
    {
        $view=str_replace('.','/', $view);

        if (file_exists( '../app/views/'. $view . '.php')) {

            require_once('../app/views/'. $view . '.php');
            
        }
        
        
        
    }
}