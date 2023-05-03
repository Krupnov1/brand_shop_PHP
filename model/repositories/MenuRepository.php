<?php

namespace app\model\repositories;

use app\engine\Db;
use app\model\Repository;
use app\engine\Session;
use app\model\entities\Menu;

class MenuRepository extends Repository {

    protected function getEntityClass() {
        return Menu::class;
    }
    
    public function getTableName() {
        return 'menu';
    }
}