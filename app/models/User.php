<?php

class User {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

//    Log in user
    public function login($data) {
        $user = $this->findUserByEmail($data['email']);

        if ($user) {
//            User exists
            if (password_verify($data['password'], $user->password)) {
//                Password correct
                return $user;
            } else {
//                Incorrect password
                return false;
            }
        } else {
//            User dosen't exist
            return false;
        }
    }

//    Register new user
    public function register($data) {

        $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');

//        Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

//        Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

//    Find user in db by email
    public function findUserByEmail($email) {

        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();

//        Check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
    
//    Get user info by id
    public function getUserById($id){
        $this->db->query('SELECT * FROM users WHERE  users.id = :id');
        $this->db->bind(':id', $id);
        $user = $this->db->single();
        return $user;
        
    }

}
