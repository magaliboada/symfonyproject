<?php

// tests/InitialPageTest.php
namespace Tests\TDDIntro;

use App\Entity\Clothing;
use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\ProductType;

class ProductTest extends \PHPUnit\Framework\TestCase
{

    public function testProducerFirst()
    {
        $this->assertTrue(true);
        return 'first';
    }

    /**
     * @depends testProducerFirst
     */
    public function testProductEntity()
    {
        $product = new Product(10.2, new ProductType('test', new ProductCategory()));

        $this->assertEquals($product->getPrice(), 10.2);
        $this->assertEquals($product->getType(), new ProductType('test', new ProductCategory()));

        $this->assertTrue(true);
    }

    public function testClothing()
    {
        $clothing = new Clothing(22.2);
//        $clothing.setPrice(22.2);

        $this->assertTrue(true);
        var_dump($clothing);
    }



}