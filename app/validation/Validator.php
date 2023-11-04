<?php
namespace app\validation;


use Controller;



class Validator extends Controller
{
    private $model;
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * validate user inputs in register and login form.
     * @param array $data
     * @return array
     */
    public function validate($data)
    {
        $validatedData = [];
        foreach ($data as $key => $value) {
            switch ($key) {
                case ('username'):
                    $value = trim($value);
                    if (
                        empty($value)
                        || strlen($value) < 3
                    ) {
                        $validatedData['username_error'] = 'username must be at least 3 characters long';
                    } else {
                        $validatedData[$key] = $value;
                    }
                    break;
                case ('email'):
                    $value = trim($value);
                    if (
                        empty($value)
                        || !filter_var($value, FILTER_VALIDATE_EMAIL)
                    ) {
                        $validatedData['email_error'] = 'Please enter a valid email';
                    } elseif (count($data) > 2 && $this->model->findByEmail($value)) {
                        $validatedData['email_error'] = 'The email is already taken';
                    } else {
                        $validatedData[$key] = $value;
                    }
                    break;
                case ('password'):
                    if (
                        empty($value)
                        || strlen($value) < 6
                    ) {
                        $validatedData['password_error'] = 'password must be at least 6 characters long';
                    } else {
                        $validatedData[$key] = $value;
                    }
                    break;
                case ('password_confirmation'):
                    if ($data['password'] !== $value || empty($data['password'])) {
                        $validatedData['password_confirmation_error'] = 'Passwords do not match';
                    } else {
                        $validatedData[$key] = $value;
                    }
            }
        }
        var_dump($validatedData);
        return $validatedData;
    }


    /**
     * cheks if the form data is valid
     * @return bool
     */

    public function isDataValid($data)
    {
        $validatedData = $this->validate($data);
        foreach ($validatedData as $key => $value) {

            if (strpos($key, 'error') !== false) {

                if (empty($validatedData[$key])) {
                    continue;
                } else {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * return the validated form data.
     * @return null|array
     */
    public function validatedFormData($data)
    {
        if ($this->isDataValid($data)) {
            return $data;
        }
    }
}