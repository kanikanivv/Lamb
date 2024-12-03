<?php

require_once dirname(__FILE__) . '/../../lib/Calculator.php';

class CalculatorTest extends \PHPUnit\Framework\TestCase
{

    private $cal;
    public function setUp(): void
    {
        $this->cal = new Calculator();
    }

    public function testAdd()
    {
        $this->assertEquals(4, $this->cal->add(2, 2), '2と2を足した場合は4であるべき');
        $this->assertEquals(6, $this->cal->add(2, 4), '2と4を足した場合は6であるべき');
    }

    public function testSubtraction()
    {
        $this->assertEquals(2, $this->cal->subtraction(7, 5), '7から5を引いた場合は2であるべき');
    }
}
