<?php

declare (strict_types = 1);

namespace Sabium\Handler;

use Sabium\Entity\Pessoa;
use JMS\Serializer\Serializer;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Sabium\Handler\CreatePessoaHandler;
use Symfony\Component\Validator\Validation;
use Sabium\Service\Validation\ObjectValidator;


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
