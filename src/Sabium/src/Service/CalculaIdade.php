<?php

namespace Sabium\Service;

class CalculaIdade
{
    public function getIdadeByDataNascimento(\DateTime $dataNascimento) : int
    {
        if ($dataNascimento > new \DateTime('today'))
        {
            throw new \InvalidArgumentException('Data inválida');
        }

        return (new \DateTime('now'))->diff($dateBirth)->y;
        return 1;
    }
}