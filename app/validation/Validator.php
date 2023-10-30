<?php
namespace app\validation;


use Controller;

/**
 * TODO: refactor using dependency injection 
 */

class Validator extends Controller
{
    private $model;
    public function __construct($model)
    {
        $this->model = $model;
    }
    /**
     * validate user input in the register form.
     * @param array $data
     * @return array
     */
     public function registerValidation($data)
    {
        $validatedData = [];
        $data['username'] = trim($data['username']);
        if (
            empty($data['username'])
            || strlen($data['username']) < 3
        ) {
            $validatedData['username_error'] = 'username must be at least 3 characters long';
        } else {
            $validatedData['username'] = $data['username'];
        }

        $data['email'] = trim($data['email']);
        if (
            empty($data['email'])
            || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)
        ) {
            $validatedData['email_error'] = 'Please enter a valid email';
        }elseif ($this->model->findByEmail($data['email'])) {
            $validatedData['email_error'] = 'The email is already taken';
        } else {
            $validatedData['email'] = $data['email'];
        }

        if (
            empty($data['password'])
            || strlen($data['password']) < 6
        ) {
            $validatedData['password_error'] = 'password must be at least 6 characters long';
        } else {
            $validatedData['password'] = $data['password'];
        }

        if ($data['password'] !== $data['password_confirmation'] || empty($data['password'])) {
            $validatedData['password_confirmation_error'] = 'Passwords do not match';
        } else {
            $validatedData['password_confirmation'] = $data['password_confirmation'];
        }

        return $validatedData;
    }

    /**
     * cheks if the form data is valid
     * @return bool|array
     */
    public function registerDataIsValid($data)
    {

        $validatedData = $this->registerValidation($data);
        return (
            empty($validatedData['username_error'])
            && empty($validatedData['email_error'])
            && empty($validatedData['password_error'])
            && empty($validatedData['password_confirmation_error'])
        )
            ? $validatedData
            : false;


    }

    /**
     * return the validated form data.
     * @return null|array
     */
    public function validatedFormData($data)
    {
        if ($this->registerDataIsValid($data)) {
           return $data;
        }
    }
}