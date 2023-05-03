<?php

namespace app\model\entities;

use app\model\Model;

class Reviews extends Model { 
    protected $id;
    protected $name;
    protected $texts;

    protected $props = [
        'name' => false,
        'texts' => false
    ];

    public function __construct($name = null, $texts = null)
    {
        $this->name = $name;
        $this->texts = $texts;
    }
}