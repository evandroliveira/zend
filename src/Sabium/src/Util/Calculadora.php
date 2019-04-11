<?php

declare(strict_types=1);

namespace Sabium\Util;

use Sabium\Exception\ArithmeticException;


class Calculadora
{
    public function soma($nu1, $nu2)
    {
        $soma = $nu1 + $nu2;
        return $soma;
    }

    public function subtrair($nu1, $nu2)
    {
        $subtrai = $nu1 - $nu2;
        return $subtrai;
    }

    public function dividir($nu1, $nu2)
    {
        if ($nu2 == 0) {
            throw new ArithmeticException('Division by Zero');
        }
        $dividir = $nu1 / $nu2;
        return $dividir;
    }
}
