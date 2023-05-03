<?php

use PHPUnit\Framework\TestCase;
use app\model\entities\Products;

class ProductsPriceTest extends TestCase {

    /**
     * @dataProvider providerProductsPrice
     */

    public function testProductsPrice($price) {

        $product = new Products($price);
        $this->assertEquals($price, $product->name);    
    }
    
    public function providerProductsPrice() {
        return [
            [1500],
            ["qwertyuiopp"],
            ['!!!!!!!!!']
        ];
    }
}