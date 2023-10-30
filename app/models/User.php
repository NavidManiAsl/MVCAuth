<?php

class User
{
    private $db;
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
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
}