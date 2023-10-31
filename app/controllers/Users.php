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
        $this->view("users.login");
    }
}