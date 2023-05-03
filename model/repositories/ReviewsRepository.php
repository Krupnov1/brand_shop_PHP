<?php

namespace app\model\repositories;

use app\engine\Db;
use app\engine\App;
use app\model\Repository;
use app\engine\Session;
use app\model\entities\Reviews;

class ReviewsRepository extends Repository { 

    protected function getEntityClass() {
        return Reviews::class;
    }

    public function reviewsEdit($id, $name, $texts) {
        $tableName = $this->getTableName();
        $sql = "UPDATE {$tableName} SET name = :name,  texts = :texts WHERE id = :id"; 
        App::call()->db->execute($sql, [
            'name' => $name,
            'texts' => $texts,
            'id' => $id
            ]);
    }
    
    public function getTableName() {
        return 'feedback'; 
    }
}