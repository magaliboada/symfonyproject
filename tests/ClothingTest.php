<?php

// tests/InitialPageTest.php
namespace Tests\TDDIntro;

use App\Entity\Clothing;
use App\Entity\ProductCategory;

class ClothingTest extends \PHPUnit\Framework\TestCase
{
    public function testClothingEntity()
    {
        $product = new Clothing(10.2);

        $this->assertEquals($product->getPrice(), 10.2);

//        $this->assertEquals($product->getType(), new ProductType('test', new ProductCategory()));

        $this->assertTrue(true);
    }

}