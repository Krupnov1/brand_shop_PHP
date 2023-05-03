<?php

namespace app\controllers;

use app\model\entities\Users;
use app\engine\Request;
use app\model\repositories\UsersRepository;
use app\engine\App;

class RegistrationController extends Controller {


    public function actionForm() {
        echo $this->render('users', [
           'title' => 'Регистрация пользователя'
        ]); 
    }

    public function actionUser() {
        $request = new Request();
        $user_name = $request->getParams()['name'];
	    $user_last_name = $request->getParams()['last_name'];
	    $user_email = $request->getParams()['email'];
	    $user_tel = $request->getParams()['tel'];
	    $user_login = $request->getParams()['login'];
        $pass = password_hash($request->getParams()['pass'], PASSWORD_DEFAULT);
        
        if ($user_name == '' || $user_last_name == '' || $user_email == '' || $user_tel == '' || $user_login == '' || $pass == '') {
            echo $this->render('message', [
                'message' => 'ERROR 404 - Все поля формы должны быть заполнены!!!'
            ]);
        } else {
            $user = new Users($user_name, $user_last_name,
            $user_email, $user_tel, $user_login, $pass);
            
            App::call()->usersRepository->save($user);

            header("Location:" . $_SERVER['HTTP_REFERER']);   
        }
    }
} 