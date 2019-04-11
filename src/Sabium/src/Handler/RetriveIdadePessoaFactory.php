<?php

declare(strict_types=1);

namespace Sabium\Handler;

use Psr\Container\ContainerInterface;

class RetriveIdadePessoaFactory
{
    public function __invoke(ContainerInterface $container) : RetriveIdadePessoa
    {
        return new RetriveIdadePessoa();
    }
}
