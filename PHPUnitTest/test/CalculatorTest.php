<?php
require_once dirname(__FILE__) . '/../lib/Calculator.php';

class CalculatorTest extends \PHPUnit\Framework\TestCase
{

  public function testAdd()
  {
    $cal = new Calculator();
    $result = $cal->add(2, 2);
  }
}
J
