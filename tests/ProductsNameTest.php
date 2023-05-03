<?php

use PHPUnit\Framework\TestCase;
use app\model\entities\Products;

class ProductsNameTest extends TestCase {

    /**
     * @dataProvider providerProductsName
     */

    public function testProductsName($name) {

        $product = new Products($name);
        $this->assertEquals($name, $product->name);    
    }
    
    public function providerProductsName() {
        return [
            ["Jacket men"],
            ["qwertyuiopp"],
            [1234567890]
        ];
    }
}

