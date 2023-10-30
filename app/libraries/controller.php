<?php

class Controller
{

    protected function model($model)
    {
        if (file_exists(APP_ROOT.'/models/' . ucfirst($model) . '.php')) {
           
            require_once(APP_ROOT . '/models/' . ucfirst($model) . '.php');
            if ($model === 'user') {
                return new User( new Database );
            } else {
                return new $model;
            }
            
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