<?php

declare (strict_types = 1);

namespace Sabium\Handler;

use Psr\Container\ContainerInterface;
use Sabium\Entity\Pessoa;
use JMS\Serializer\Serializer;
use Sabium\Handler\UpdatePessoaHandler;
use Symfony\Component\Validator\Validation;

class UpdatePessoaHandlerFactory
{
    public function __invoke(ContainerInterface $container): UpdatePessoaHandler
    {
        $entityManager = $container->get('Doctrine\ORM\EntityManager');
        $repository = $entityManager->getRepository(Pessoa::class);
        $serializer = $container->get(Serializer::class);
        return new UpdatePessoaHandler($repository, $serializer);
    }
}
