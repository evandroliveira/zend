<?php

namespace Sabium\Container;

use JMS\Serializer\SerializerBuilder;
use Psr\Container\ContainerInterface;
use Doctrine\Common\Annotations\AnnotationRegistry;

class JMSFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $loader = require __DIR__ . '/../../../../vendor/autoload.php';
        AnnotationRegistry::registerLoader(array($loader, 'loadClass'));
        AnnotationRegistry::registerAutoloadNamespace('Symfony\Component\Validator\Constraints', '/vendor/symfony/validator');

        AnnotationRegistry::registerAutoloadNamespace(
            "Symfony\Component\Validator\Constraints",
            'vendor/symfony/validator'
        );

        $serializer = SerializerBuilder::create()->setPropertyNamingStrategy(
            new \JMS\Serializer\Naming\SerializedNameAnnotationStrategy(
                new \JMS\Serializer\Naming\IdenticalPropertyNamingStrategy()
            )
        )->build();

        return $serializer;
    }
}
