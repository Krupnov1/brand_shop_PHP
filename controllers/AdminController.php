<?php

namespace app\controllers;

use app\model\Admin;
use app\model\repositories\AdminRepository;
use app\model\repositories\OrdersRepository;
use app\engine\App;

class AdminController extends Controller {

    public function actionManagement() {
        echo $this->render('admin', [
           'admin' => App::call()->ordersRepository->getAdminOrders(), 
           'title' => 'Админ'
        ]); 
    }

    public function actionEdit() {
        
        $id = App::call()->request->getParams()['id'];
        $status = App::call()->request->getParams()['input'];

        App::call()->ordersRepository->statusEdit($id, $status);

        $response = [
            'success' => 'ok',
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function actionDelete() {
        
        $id = App::call()->request->getParams()['id'];
        
        $orders = App::call()->ordersRepository->getOneObject($id);
        
        if ($id == $orders->id) {
            App::call()->ordersRepository->delete($orders);
        }

        $response = [
            'success' => 'ok',
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}  