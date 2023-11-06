<?php
namespace App\Libraries;

use App\Helpers\ErrorHandler;

class Controller
{

    /**
     * loads a model file instantiate it and inject the provided dependencies.
     * @param string $model
     * @param array $dependencies
     * @return object|void
     */
    protected function model($model, $dependencies = [])
    {
        try {
            $model = ucfirst($model);
            if (file_exists(APP_ROOT . '/models/' . ucfirst($model) . '.php')) {

                require_once(APP_ROOT . '/models/' . ucfirst($model) . '.php');

                $class = 'App\\Models\\' . $model;
                return new $class($dependencies);

            } else {
                throw new \Exception('Model not found.');
            }
        } catch (\Exception $e) {
            ErrorHandler::handleError($e);
        }
    }

    /**
     * Loads and renders a specified view file.
     * @param string $view
     * @param array $data
     * @return void
     */
    protected function view($view, $data = [])
    {
        $view = str_replace('.', '/', $view);

        if (file_exists('../app/views/' . $view . '.php')) {

            require_once('../app/views/' . $view . '.php');

        }
    }
}