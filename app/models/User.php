<?php

class User
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * Check if a given email is already exist in database.
     * @return bool
     */
    public function findByEmail($email)
    {
        $query = 'SELECT * FROM users WHERE email=:email';
        $this->db->query($query);
        $this->db->bind(':email', $email);
        $result = $this->db->result();
        if ($this->db->rowCount() > 0) {
            return true;
        }
        return false;
    }

    /**
     * Create and save a new user in database.
     * @param array $formData
     * @return bool
     */
    public function create($formData)
    {
        try {
            $query = ' INSERT INTO  users(username,email,password) VALUES (:username, :email, :password)';
            $this->db->query($query);
            $this->db->bind(':username', $formData['username']);
            $this->db->bind(':email', $formData['email']);
            $this->db->bind(':password', password_hash($formData['password'], PASSWORD_DEFAULT));

            return $this->db->execute();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }

    /**
     * Authenticate a user with given credentials
     * @param array $formData
     * @return User|false
     */
    public function login($formData)
    {
        $query = 'SELECT * FROM users WHERE email=:email';
        try {
            $this->db->query($query);
            $this->db->bind(':email', $formData['email']);
            $user = $this->db->result();

            if ($user && password_verify($formData['password'], $user->password)) {

                sessionUserAdd($user);

                return $user;
            } else {
                return false;
            }
        } catch (\Throwable $th) {

        }
    }

    /**
     * Log out user and end the session.
     * @return void
     */
    public function logout()
    {
        unset($_SESSION);
        
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 4200, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        
        session_destroy();
    }
}