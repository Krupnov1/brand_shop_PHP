<?php

namespace app\model\repositories;

use app\engine\App;
use app\engine\Db;
use app\model\Repository;
use app\engine\Session;
use app\model\entities\Basket;
use app\controllers\BasketController;

class BasketRepository extends Repository {

    public function getBasketCatalog($session_id) {
        $tableName = $this->getTableName();
        $sql = "SELECT basket.id as id_basket, id_session, id_product, quantity, 
                products.id, products.name, products.description, price, image_size, image_file, image_alt, likes  
                FROM {$tableName} INNER JOIN products on products.id = basket.id_product WHERE id_session = :session";
        return App::call()->db->queryAll($sql, ['session' => $session_id]);
    }

    public function getBasketOrders($session_id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id_session = :session";
        return App::call()->db->queryAll($sql, ['session' => $session_id]);
    }

    public function delBasketOrders($session_id) {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id_session = :session";
        return App::call()->db->execute($sql, ['session' => $session_id]);
    }

    public function getBasketProduct($id_product, $session_id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id_product = :id_product AND id_session = :session";
        return App::call()->db->queryAll($sql, [
            'id_product' => $id_product,
            'session' => $session_id
            ]);
    }

    public function quantityAdd($id_product, $new_quantity, $session_id) {
        $tableName = $this->getTableName();
        $sql = "UPDATE {$tableName} SET quantity = :quantity WHERE id_product = :id_product AND id_session = :session";
        App::call()->db->execute($sql, [
            'quantity' => $new_quantity,
            'id_product' => $id_product,
            'session' => $session_id 
            ]);
    }

    public function getBasketSum($session_id) {
        $tableName = $this->getTableName();
        $sql = "SELECT sum(price * quantity) as sum FROM {$tableName} INNER JOIN products on 
        basket.id_product = products.id WHERE id_session = :session";
        return App::call()->db->queryAll($sql, ['session' => $session_id]);
    }

    protected function getEntityClass() {
        return Basket::class;
    }

    public function getTableName() {
        return 'basket';
    }
}