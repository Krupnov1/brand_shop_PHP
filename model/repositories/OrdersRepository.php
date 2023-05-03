<?php

namespace app\model\repositories;

use app\engine\Db;
use app\engine\App;
use app\model\Repository;
use app\engine\Session;
use app\model\entities\Orders;

class OrdersRepository extends Repository {

    protected function getEntityClass() {
        return Orders::class;
    }

    public function isAdmin() {
        $session = new Session();
        return $session->getSession('login');  
    }

    public function getAdminOrders() {
        if ($this->isAdmin()) {
            $tableName = $this->getTableName();
            $sql = "SELECT id, name, email, phone, id_product, quantity, date, status, ROW_NUMBER() over (order by name) as 
            number FROM {$tableName}";
            return App::call()->db->queryAll($sql);
        } else {
            header("Location: /");
        } 
    }

    public function statusEdit($id, $status) {
        $tableName = $this->getTableName();
        $sql = "UPDATE {$tableName} SET status = :status WHERE id = :id"; 
        App::call()->db->execute($sql, [
            'status' => $status,
            'id' => $id
            ]);
    }
    
    public function getTableName() { 
        return 'orders';
    } 
}