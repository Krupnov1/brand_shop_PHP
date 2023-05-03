<?php

namespace app\controllers;

use app\engine\Request;
use app\model\entities\Basket;
use app\model\repositories\BasketRepository;

class BasketController extends Controller {

    public function actionAll() {
        echo $this->render('basket', [
            'basket' => (new BasketRepository())->getBasketCatalog(session_id()),
            'sum' => (new BasketRepository())->getBasketSum(session_id()),
            'title' => 'Корзина'
        ]); 
    }

    public function actionAdd() {
        $request = new Request();
        
        $id_product = $request->getParams()['id'];
        $quantity_product = $request->getParams()['quantity'];
        
        $basket = (new BasketRepository())->getBasketProduct($id_product, session_id()); 
        
        if ($basket == NULL) {
            $basket = new Basket(session_id(), $id_product, $quantity_product);
            (new BasketRepository())->save($basket);      
        } else {
            foreach ($basket as $item) {
                $new_quantity = $quantity_product + $item['quantity'];
            }
            (new BasketRepository())->quantityAdd($id_product, $new_quantity, session_id());
        } 
        $response = [
            'success' => 'ok',
            'count' => (new BasketRepository())->getCountWhere('id_session', session_id())
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function actionEdit() {
        $request = new Request();

        $id_product = $request->getParams()['id_product'];
        $quantity = $request->getParams()['quantity'];

        (new BasketRepository())->quantityAdd($id_product, $quantity, session_id());

        $response = [
            'success' => 'ok',
            'count' => (new BasketRepository())->getCountWhere('id_session', session_id())
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function actionDelete() {
        $request = new Request();
        
        $id = $request->getParams()['id_basket'];
        $quantity = $request->getParams()['quantity'];
        $id_product = $request->getParams()['id_product'];
        
        if ($quantity == 1) {
            $session = session_id();
            $basket = (new BasketRepository())->getOneObject($id); 

            if ($session == $basket->id_session) {
                (new BasketRepository())->delete($basket);
            }

        } else {
            $new_quantity = $quantity - 1;
            (new BasketRepository())->quantityAdd($id_product, $new_quantity, session_id());
        }

        $response = [
            'success' => 'ok',
            'count' => (new BasketRepository())->getCountWhere('id_session', session_id())
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
} 
