<?php

namespace app\model\entities;

use app\model\Model;

class Orders extends Model {
    protected $id;
    protected $name;
    protected $email;
    protected $phone;
    protected $id_product;
    protected $quantity;
    protected $session_id;
    protected $date;
    protected $status;

    protected $props = [
        'name' => false,
        'email' => false,
        'phone' => false,
        'id_product' => false,
        'quantity' => false,
        'session_id' => false,
        'date' => false,
        'status' => false
    ];

    public function __construct($name = null, $email = null, $phone = null, $id_product = null, 
                                $quantity = null, $session_id = null, $date = null, $status = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->id_product = $id_product;
        $this->quantity = $quantity;
        $this->session_id = $session_id;
        $this->date = $date;
        $this->status = $status;
    }
}