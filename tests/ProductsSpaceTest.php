<?php

use PHPUnit\Framework\TestCase;
use app\model\entities\Products;

class ProductsSpaceTest extends TestCase {

    public function testSpace() {

        $nameSpace = Products::class;
        $space = explode("\\", $nameSpace);
        $name = 'Products';
        $this->assertEquals($name, $space[3]);
        
    }
}