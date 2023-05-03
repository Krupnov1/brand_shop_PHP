<?php

namespace app\model\entities;

use app\engine\Session;
use app\model\Model;

class Users extends Model {

    protected $id;
    protected $name;
    protected $last_name;
    protected $email;
    protected $telephone;
    protected $login;
    protected $password;

    protected $props = [
        'name' => false,
        'last_name' => false,
        'email' => false,
        'telephone' => false,
        'login' => false,
        'password' => false
    ];

    public function __construct($name = null, $last_name = null, $email = null, 
                                $telephone = null, $login = null, $password = null)
    {
        $this->name = $name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->login = $login;
        $this->password = $password;  
    }
}