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
}