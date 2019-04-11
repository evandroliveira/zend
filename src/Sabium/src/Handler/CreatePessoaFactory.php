<?php

declare (strict_types = 1);

namespace Sabium\Handler;

use Psr\Container\ContainerInterface;
use Sabium\Entity\Pessoa;
use JMS\Serializer\Serializer;
use Symfony\Component\Validator\Validation;
use Sabium\Handler\CreatePessoaHandler;
use Sabium\Service\Validation\ObjectValidator;


class CreatePessoaFactory
{
    public function __invoke(ContainerInterface $container): CreatePessoaHandler
    {
        $entityManager = $container->get('Doctrine\ORM\EntityManager');        
        $repository = $entityManager->getRepository(Pessoa::class);
        $serializer = $container->get(Serializer::class);        
        $validation = $container->get(Validation::class);
        $objectValidator = $container->get(ObjectValidator::class);

        return new CreatePessoaHandler($repository, $serializer, $validation, $objectValidator);
    }
}
