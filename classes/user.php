<?php 

class user {
    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $role;
    protected $status;

    public function __construct () 
    {

    }

    public function setId ($id) {
        $this->id = $id;
    }

    public function getId () {
        return $this->id;
    }

    public function setUsername ($username) {
        $this->username = $username;
    }
    
    public function getUsername () {
        return $this->username;
    }

    public function setEmail ($email) {
        $this->email = $email;
    }
    
    public function getEmail () {
        return $this->email;
    }
    
    public function setPassword ($password) {
        $this->password = $password;
    }
    
    public function getPassword () {
        return $this->password;
    }

    public function setRole ($role) {
        $this->role = $role;
    }
    
    public function getRole () {
        return $this->role;
    }

    public function setStatus ($status) {
        $this->status = $status;
    }
    
    public function getStatus () {
        return $this->status;
    }

    public function login ($email, $passwordm, $role)
    {

    }

    public function logout() 
    {

    }

}