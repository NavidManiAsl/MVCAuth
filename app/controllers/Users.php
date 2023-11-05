<?php
namespace App\Controllers;

use App\Libraries\{Controller, Database};
use App\Helpers\{Validator, Logger};

class Users extends Controller
{

    private $model;
    private $validator;
    public function __construct()
    {
        $this->model = $this->model('user', new Database());
        $this->validator = new Validator($this->model);
    }

    public function index()
    {

        if ($this->isAuthenticated()) {
            $this->view('users.index');
        } else {
            $this->view('users.login');
        }
    }

    public function register($method, $params = null)
    {

        $data = [
            "username" => "",
            "email" => "",
            "password" => "",
            "password_confirmation" => "",
            "username_error" => "",
            "email_error" => "",
            "password_error" => "",
            "password_confirmation_error" => "",
        ];
        if ($method === "POST") {

            foreach ($_POST as $key => $value) {
                $_POST[$key] = htmlspecialchars($value, ENT_QUOTES, 'utf-8');
            }

            if ($this->validator->isDataValid($_POST)) {
                try {
                    if ($this->model->create($_POST)) {
                        Logger::log(
                            [
                                'action' => 'register',
                                'username' => $_POST['username'],
                                'email' => $_POST['email'],
                            ],
                            'access'
                        );
                        flash('success', 'registeration completed!');
                        redirect('users.login');
                    }
                } catch (\Throwable $th) {
                }
            } else {
                $this->view('users.register', array_merge($data, $this->validator->validate($_POST)));
            }
        } else {
            $this->view("users.register", $data);
        }
    }

    public function login($method, $params = null)
    {
        $data = [
            'email' => '',
            'password' => '',
            'email_error' => '',
            'password_error' => '',
        ];

        if ($method === 'POST') {

            foreach ($_POST as $key => $value) {
                $_POST[$key] = htmlspecialchars($value, ENT_QUOTES, 'utf-8');
            }
            if ($this->validator->isDataValid($_POST)) {
                $user = $this->model->login($_POST);
                if ($user) {
                    session_regenerate_id(true);
                    Logger::log(
                        [
                            'action' => 'Login',
                            'id' => $_SESSION['user_id'],
                            'email' => $_SESSION['email'],
                        ],
                        'access'
                    );
                    flash('login_success', 'Welcome back!');
                    redirect('users.index');
                } else {
                    flash('login_failed', 'Invalid credentials please try again');
                    $this->view('users.login');
                }

            } else {
                $this->view('users.login', array_merge($data, $this->validator->validate($_POST)));
            }



        }
        $this->view("users.login");
    }

    public function logout()
    {
        if ($this->isAuthenticated()) {
            Logger::log(
                [
                    'action' => 'Logout',
                    'id' => $_SESSION['user_id'],
                    'email' => $_SESSION['email'],
                ],
                'access'
            );
            $this->model->logout();
            redirect('users.login');
        }
    }

    public function isAuthenticated()
    {
        return isset($_SESSION['user_id']);
    }
}