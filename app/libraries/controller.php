<?php

class Controller
{

    protected function model($model , $dependencies )
    {
        if (file_exists(APP_ROOT.'/models/' . ucfirst($model) . '.php')) {
           
            require_once(APP_ROOT . '/models/' . ucfirst($model) . '.php');
         
                return new $model($dependencies);
            
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