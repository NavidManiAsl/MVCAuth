<?php

class Users extends Controller
{
    public function register()
    {
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        } else {
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
            $this->view("users.register", $data);
        }
    }
    public function login(){$this->view("users.login");}
}