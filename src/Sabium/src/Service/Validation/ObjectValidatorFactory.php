<?php

namespace Sabium\Service\Validation;

use Sabium\Service\Validation\ObjectValidator;
use Symfony\Component\Validator\Validation;
use Psr\Container\ContainerInterface;

class ObjectValidatorFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ObjectValidator($container->get(Validation::class));
    }
}
