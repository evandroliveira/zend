<?php

declare(strict_types=1);

namespace Sabium\Middleware;

use Sabium\Entity\Pessoa;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class PessoaEndpointValidatorFactory
{
    public function __invoke(ContainerInterface $container) : PessoaEndpointValidator
    {
       $entityManager = $container->get(EntityManager::class);
       $pessoaRepository = $entityManager->getRepository(Pessoa::class);
       return new PessoaEndPointValidator($pessoaRepository);
    }
}
