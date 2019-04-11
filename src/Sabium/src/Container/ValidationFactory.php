<?php

namespace Sabium\Container;

use Interop\Container\ContainerInterface;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\Validator\Validation;
use Composer\Autoload\ClassLoader;

/**
 * @var ClassLoader $loader
 */

class ValidationFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $loader = require __DIR__ . '/../../../../vendor/autoload.php';

        AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();
            
        return $validator;
    }
}
