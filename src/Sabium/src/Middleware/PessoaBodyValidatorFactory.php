<?php

declare(strict_types=1);

namespace Sabium\Middleware;

use Psr\Container\ContainerInterface;
use Symfony\Component\Validator\Validation;
use Sabium\Service\Validation\ObjectValidator;

class PessoaBodyValidatorFactory
{
    public function __invoke(ContainerInterface $container) : PessoaBodyValidator
    {  
        $validation = $container->get(Validation::class);
        $serializer = $container->get('serializer');
        $objectValidator = $container->get(ObjectValidator::class);
        return new PessoaBodyValidator($serializer, $validation, $objectValidator);
    }
}