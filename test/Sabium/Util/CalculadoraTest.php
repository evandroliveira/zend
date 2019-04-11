<?php

declare(strict_types=1);

namespace Sabium\Util;

use Sabium\Util\Calculadora;
use PHPUnit\Framework\TestCase;

class CalculadoraTest extends TestCase
{
    public function testSoma()
    {
        $calculadora = new Calculadora();
        $soma = $calculadora->soma(5,5);
        $this->assertEquals(10, $soma);
    }

     /**
     *  @ExpectedException InvalidArgumentException
     */
    public function testSomaComNumeroNegativo()
    {
        $calculadora = new Calculadora();
        $soma = $calculadora->soma(-1, 5);
        $this->assertEquals(4, $soma);
    }

    public function testSubtracaoDezComDez()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->subtrair(10,10);
        $this->assertEquals(0, $resultado);
    }

    /**
     *  @expectedException          \Sabium\Exception\ArithmeticException
     *  @expectedExceptionMessage   Division by Zero
     */
    public function testDivisionByZero()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->dividir(100, 0);   
    }

    public function testDividirZeroPorCem()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->dividir(0,100);
        $this->assertEquals(0, $resultado);
    }

}
