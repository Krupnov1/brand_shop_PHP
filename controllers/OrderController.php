<?php

namespace app\controllers;

use app\engine\Request;
use app\engine\Render;
use app\model\entities\Orders;
use app\model\repositories\OrdersRepository;
use app\model\repositories\BasketRepository;
use app\engine\App;

class OrderController extends Controller {

    public function actionAdd() {

        $basket = (new BasketRepository())->getBasketOrders(session_id()); 
        
        foreach($basket as $item) {
        $status = "Новый заказ";
        $date = date("d/m/Y в H:i:s");
        $name = App::call()->request->getParams()['name'];
        $email = App::call()->request->getParams()['email'];
        $phone = App::call()->request->getParams()['phone'];
        $orders = new Orders($name, $email, $phone, $item['id_product'], $item['quantity'], session_id(), $date, $status);
            App::call()->ordersRepository->save($orders);
        }

        App::call()->basketRepository->delBasketOrders(session_id());
        

        $response = [
            'success' => 'ok',
            'count' => (new BasketRepository())->getCountWhere('id_session', session_id()),
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}