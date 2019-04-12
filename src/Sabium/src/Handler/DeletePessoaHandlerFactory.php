<?php

declare (strict_types = 1);

namespace Sabium\Handler;

use Psr\Container\ContainerInterface;
use Sabium\Entity\Pessoa;
use JMS\Serializer\Serializer;
use Sabium\Handler\DeletePessoaHandler;

class DeletePessoaHandlerFactory
{
    public function __invoke(ContainerInterface $container): DeletePessoaHandler
    {
        $entityManager = $container->get('Doctrine\ORM\EntityManager');
        $repository = $entityManager->getRepository(Pessoa::class);
        $serializer = $container->get('serializer');
        return new DeletePessoaHandler($repository, $serializer);
    }
}
