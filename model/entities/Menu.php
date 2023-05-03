<?php

namespace app\model\entities;

use app\model\Model;

class Menu extends Model {
    
    protected $id;
    protected $name;
    protected $route;

    protected $props = [
        'name' => false,
        'route' => false
    ];

    public function __construct($name = null, $route = null)
    {
        $this->name = $name;
        $this->route = $route;
    }
}
