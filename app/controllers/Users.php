<?php
use app\validation\Validator;

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
        $this->view('users.index');
    }

    public function register()
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            foreach ($_POST as $key => $value) {
                $_POST[$key] = htmlspecialchars($value, ENT_QUOTES, 'utf-8');
            }

            if ($this->validator->registerDataIsValid($_POST)) {
                try {
                    $this->model->create($_POST);
                    flash('success', 'registeration completed!');
                    redirect('users/login');
                } catch (Throwable $th) {
                }
            } else {
                $this->view('users.register', array_merge($data, $this->validator->registerValidation($_POST)));
            }
        } else {
            $this->view("users.register", $data);
        }
    }

    public function login()
    {
        $data = [
            'email' => '',
            'password' => '',
            'email_error' => '',
            'password_error' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            foreach ($_POST as $key => $value) {
                $_POST[$key] = htmlspecialchars($value, ENT_QUOTES, 'utf-8');
            }
            if ($this->validator->loginDataIsValid($_POST)) {
                $row = $this->model->login($_POST);
                if ($row) {
                    flash('login_success', 'Welcome back!');
                    sessionUserAdd($row);
                    redirect('users/index');
                } else {
                    flash('login_failed', 'Invalid credentials please try again');
                    $this->view('users.login');
                }

            } else {
                $this->view('users.login', array_merge($data, $this->validator->loginValidation($_POST)));
            }



        }
        $this->view("users.login");
    }
}