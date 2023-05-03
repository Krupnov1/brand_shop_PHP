<?php

use PHPUnit\Framework\TestCase;
use app\model\entities\Products;

class ProductsPropsTest extends TestCase {

    public function testProductsProps() {

        $name = "Jacket men";
        $product = new Products($name);
        if ($product->name != null) {
            $props['name'] = true;
        }
        $this->assertEquals(true, $props['name']);    
    }
}