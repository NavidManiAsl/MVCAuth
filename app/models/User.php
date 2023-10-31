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
     * @return bool
     */
    public function create($data)
    {
        try {
            $query = ' INSERT INTO  users(username,email,password) VALUES (:username, :email, :password)';
            $this->db->query($query);
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
            
            return $this->db->execute();
        } catch (\Throwable $th) {
           echo $th->getMessage();
           return false;
        }
    }
}