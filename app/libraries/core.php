<?php

namespace App\Libraries;

use App\Helpers\ErrorHandler;
use Exception;

class Core
{
    protected $currentController = 'users';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();
        try {
            if (isset($url) && file_exists(APP_ROOT . '/controllers/' . ucwords($url[0]) . '.php')) {

                require_once(APP_ROOT . '/controllers/' . $this->currentController . '.php');
                $this->currentController = new('App\\Controllers\\' . $this->currentController);
                unset($url[0]);
            } else {
                throw new Exception('Controller not found');
            }
        } catch (\Throwable $th) {
            ErrorHandler::notFound($th);
        }

        try {
            if (isset($url[1]) && method_exists($this->currentController, $url[1])) {

                $this->currentMethod = $url[1];
                unset($url[1]);

            } else {
                throw new Exception('Method not found');
            }
        } catch (\Throwable $th) {
            ErrorHandler::notFound($th);
        }

        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if ($url) {
            $params = array_values($url);
            array_unshift($params, $requestMethod);
            $this->params = $params;
        } else {
            $this->params = [$requestMethod];
        }
        call_user_func_array([
            $this->currentController,
            $this->currentMethod
        ], $this->params);
    }

    /**
     * Collects the data sent in the url.
     * @return array|void
     */


    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}