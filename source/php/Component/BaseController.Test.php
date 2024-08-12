<?php

use ComponentLibrary\Component\BaseController;

class BaseControllerTest extends PHPUnit\Framework\TestCase
{
    public function testBuildAttributesReturnsAllAttributesAsString()
    {
        $attributes = ['One' => 'one', 'Two' => 'two'];
        $this->assertEquals('One="one" Two="two"', BaseController::buildAttributes($attributes));
    }

    public function testBuildAttributesAllowsArrayAsValue()
    {
        $attributes = ['One' => ['foo']];
        $this->assertEquals('One="[&quot;foo&quot;]"', BaseController::buildAttributes($attributes));
    }
 
    public function testAllowsZeroAsString()
    {
        $attributes = ['Zero' => '0'];
        $this->assertEquals('Zero="0"', BaseController::buildAttributes($attributes));
    }
    
    public function testAllowZeroAsInteger()
    {
        $attributes = ['Zero' => 0];
        $this->assertEquals('Zero="0"', BaseController::buildAttributes($attributes));
    }
}
