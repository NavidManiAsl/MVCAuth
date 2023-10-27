<?php
namespace app\libraries;
class Controller
{

    protected function model($model)
    {
        if (file_exists(__DIR__ . '../app/models/' . ucfirst($model) . '.php')) {
           
            require_once(__DIR__ . '../app/models/' . ucfirst($model) . '.php');
            return new $model;
        }
    }

    protected function view($view,$data=[])
    {
        $view=str_replace('.','/', $view);

        if (file_exists( '../app/views/'. $view . '.php')) {

            require_once('../app/views/'. $view . '.php');
            
        }
        
        
        
    }
}