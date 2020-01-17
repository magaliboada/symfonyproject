<?php

// tests/InitialPageTest.php
namespace Tests\TDDIntro;

use App\Entity\Clothing;
use App\Entity\ProductCategory;

class ClothingTest extends \PHPUnit\Framework\TestCase
{
    public function testClothingEntity()
    {
        $clothing = new Clothing(10.2);
        $clothing->setSize("XS");

        $this->assertEquals($clothing->getPrice(), 10.2);
        $this->assertEquals($clothing->getSize(), "XS");

        $this->assertTrue(true);
    }

}