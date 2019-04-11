<?php

declare (strict_types = 1);

namespace Sabium\Handler;

use Psr\Container\ContainerInterface;
use Sabium\Entity\Pessoa;
use JMS\Serializer\Serializer;
use Sabium\Handler\RetrievePessoaHandler;

class RetrievePessoaFactory
{
    public function __invoke(ContainerInterface $container): RetrievePessoaHandler
    {
        $entityManager = $container->get('Doctrine\ORM\EntityManager');
        $repository = $entityManager->getRepository(Pessoa::class);
        $serializer = $container->get(Serializer::class);
        return new RetrievePessoaHandler($repository, $serializer);
    }
}
