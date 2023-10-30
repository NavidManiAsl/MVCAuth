<?php
use app\validation\Validator;

class Users extends Controller
{
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
            if (Validator::registerDataIsValid($_POST)) {
                $this->view('users.login');
            } else {
                $this->view('users.register', array_merge($data, Validator::registerValidation($_POST)));
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