<?php

declare (strict_types = 1);

namespace Sabium\Handler;

use Psr\Container\ContainerInterface;
use Sabium\Entity\Pessoa;
use JMS\Serializer\Serializer;
use Sabium\Handler\UpdatePessoaHandler;
use Doctrine\ORM\EntityManager;

class UpdatePessoaHandlerFactory
{
    public function __invoke(ContainerInterface $container): UpdatePessoaHandler
    {
        $entityManager = $container->get(EntityManager::class);
        $repository = $entityManager->getRepository(Pessoa::class);
        $serializer = $container->get('serializer');
        return new UpdatePessoaHandler($repository, $serializer);
    }
}
