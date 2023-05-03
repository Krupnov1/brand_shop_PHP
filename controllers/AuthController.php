<?php

namespace app\controllers;

use app\engine\Request;
use app\engine\Session;
use app\model\repositories\UsersRepository;
use app\model\Users;
use app\engine\App;

class AuthController extends Controller {

    public function actionLogin() {
        
        $login = App::call()->request->getParams()['login'];
        $pass = App::call()->request->getParams()['pass'];
        if (App::call()->usersRepository->auth($login, $pass)) {
            header("Location: /");
        } else {
            echo $this->render('message', [
                'errors' => 'ERROR 404 - Неверный логин или пароль!!!'
            ]);
        }
    }

    public function actionLogout() {
        
        App::call()->session->destroySession();
        header("Location:" . $_SERVER['HTTP_REFERER']);
    }
}