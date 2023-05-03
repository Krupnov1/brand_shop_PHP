<?php

namespace app\model\repositories;

use app\engine\Db;
use app\model\Repository;
use app\engine\Session;
use app\model\entities\Users;

class UsersRepository extends Repository {

    public function auth($login, $pass) {
        $session = new Session();
        $user = $this->getWhere('login', $login);
        if (password_verify($pass, $user->password)) {
            $session->setSession('login', $login);
            $session->setSession('id', $user->id);
            return true;
        } else {
            return false;
        }
    }

    public function isAuth() {
        $session = new Session();
        return $session->getSession('login');
    }

    public function getName() {
        $session = new Session();
        return $session->getSession('login'); 
    }

    protected function getEntityClass() {
        return Users::class;
    }
    
    public function getTableName() {
        return 'users';
    }
}

