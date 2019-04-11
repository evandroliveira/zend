<?php

namespace Sabium\Container;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Interop\Container\ContainerInterface;

class DoctrineFactory
{
    public function __invoke(ContainerInterface $container): EntityManager
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $proxyDir = (isset($config['doctrine']['connection']['orm']['proxy_dir'])) ?
            $config['doctrine']['connection']['orm']['proxy_dir'] : 'data/cache/EntityProxy';
        $proxyNamespace = (isset($config['doctrine']['connection']['orm']['proxy_namespace'])) ?
            $config['doctrine']['connection']['orm']['proxy_namespace'] : 'EntityProxy';
        $autoGenerateProxyClasses = (isset($config['doctrine']['connection']['orm']['auto_generate_proxy_classes'])) ?
            $config['doctrine']['connection']['orm']['auto_generate_proxy_classes'] : true;
        $underscoreNamingStrategy = (isset($config['doctrine']['connection']['orm']['underscore_naming_strategy'])) ?
            $config['doctrine']['connection']['orm']['underscore_naming_strategy'] : true;
        $doctrine = new Configuration();
        $doctrine->setProxyDir($proxyDir);
        $doctrine->setProxyNamespace($proxyNamespace);
        $doctrine->setAutoGenerateProxyClasses($autoGenerateProxyClasses);
        if ($underscoreNamingStrategy) {
            $doctrine->setNamingStrategy(new UnderscoreNamingStrategy());
        }

        AnnotationRegistry::registerLoader(
            function ($className) {
                return class_exists($className);
            }
        );

        AnnotationRegistry::registerAutoloadNamespace(
            'JMS\Serializer\Annotation',
            'vendor/jms/serializer/src'
        );

        AnnotationRegistry::registerAutoloadNamespace(
            "Symfony\Component\Validator\Constraints",
            'vendor/symfony/validator'
        );

        AnnotationRegistry::registerFile('vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');
        $driver = new AnnotationDriver(
            new AnnotationReader(),
            [__DIR__ . '/../../../Sabium/src/Entity']
        );


        $doctrine->setMetadataDriverImpl($driver);
        return EntityManager::create($config['doctrine']['connection']['orm_postgres'], $doctrine);
    }
}
