<?php

namespace app\model\repositories;

use app\engine\Db;
use app\engine\App;
use app\model\Repository;
use app\engine\Session;
use app\model\entities\Products;

class ProductsRepository extends Repository {

    protected function getEntityClass() {
        return Products::class;
    }

    public function updateLikes($id) {
        $tableName = $this->getTableName();
        $sql = "UPDATE {$tableName} SET likes = likes + 1 WHERE id = {$id}";
        App::call()->db->execute($sql, [
            'id' => $id,
        ]);
    }

    public function getTableName() {
        return 'products';
    }
}