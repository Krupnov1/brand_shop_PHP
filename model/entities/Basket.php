<?php

namespace app\model\entities;

use app\engine\Db;
use app\model\Model;

class Basket extends Model {
    protected $id;
    protected $id_session;
    protected $id_product;
    protected $quantity;

    protected $props = [
        'id_session' => false,
        'id_product' => false,
        'quantity' => false
    ];

    public function __construct($id_session = null, $id_product = null, $quantity = null)
    {
        $this->id_session = $id_session;
        $this->id_product = $id_product;
        $this->quantity = $quantity;
    }
}
