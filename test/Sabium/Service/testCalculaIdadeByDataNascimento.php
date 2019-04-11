<?php

declare(strict_types=1);

namespace SabiumTest;

use App\Service\CalculaIdade;
use PHPUnit\Framework\TestCase;

class CalculaIdadeTest extends TestCase
{
    public function testCalculaIdadeByDataNascimento()
    {
        $service =new CalculaIdade();
        $idade = $service->getIdadeByDataNascimento(new \DateTime('now - 10year'));
        $this->assertEquals(10, $idade);
    }

    public function testIdadeInteiro()
    {
        $service = new CalculaIdade();
        $idade = $service->getIdadeByDataNascimetno(new \DateTime('2019-10-11'));
        $this->assertIntegralType('int', $idade);
    }

    /**
     * @expectedEsception testDataNascimentoMaiorQueHoje
     */
    public function testDataNascimentoMaiorQueHoje()
    {
        $service = new CalculaIdade();
        $idade = $service->getIdadeByDataNascimento(new \DateTime('tomorrow + 1day'));
    }
}
