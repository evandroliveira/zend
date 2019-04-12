<?php

declare (strict_types = 1);

namespace Sabium\Handler;

use Sabium\Entity\Pessoa;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Sabium\Handler\CreatePessoaHandler;

class CreatePessoaFactory
{
    public function __invoke(ContainerInterface $container): CreatePessoaHandler
    {
        
        $entityManager = $container->get(EntityManager::class);        
        $repository = $entityManager->getRepository(Pessoa::class);
        $serializer = $container->get('serializer');        
        return new CreatePessoaHandler($repository, $serializer);
    }
}
