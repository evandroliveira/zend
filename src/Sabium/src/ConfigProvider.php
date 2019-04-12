<?php

declare (strict_types = 1);

namespace Sabium;

use JMS\Serializer\Serializer;
use Doctrine\ORM\EntityManager;
use Sabium\Container\JMSFactory;
use Zend\Expressive\Application;
use Sabium\Handler\CreatePessoaFactory;
use Sabium\Handler\CreatePessoaHandler;
use Symfony\Component\Validator\Validation;
use Sabium\Service\Validation\ObjectValidator;
use ContainerInteropDoctrine\EntityManagerFactory;

/**
 * The configuration provider for the Sabium module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'doctrine'     => $this->getDoctrineEntities(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'delegators' => [
                Application::class => [
                    RoutesDelegator::class,
                ],
            ],
            'invokables' => [],
            'factories'  => [
                'sabium-db' => Container\ConnectionFactory::class,
                EntityManager::class => EntityManagerFactory::class,
                'serializer' => JMSFactory::class,
                Validation::class => Container\ValidationFactory::class,
                ObjectValidator::class => Service\Validation\ObjectValidatorFactory::class,
                CreatePessoaHandler::class => CreatePessoaFactory::class,
                Handler\UpdatePessoaHandler::class => Handler\UpdatePessoaHandlerFactory::class,
                Handler\RetrievePessoaHandler::class => Handler\RetrievePessoaFactory::class,
                Handler\DeletePessoaHandler::class => Handler\DeletePessoaHandlerFactory::class,
                Container\JSONMapperFactory::class => Container\JSONMapperFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'sabium'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }

    public function getDoctrineEntities(): array
    {
        return [
            'driver' => [
                'orm_default' => [
                    'class' => MappingDriverChain::class,
                    'drivers' => [
                        'Sabium\Entity' => 'sabium_entity',
                    ],
                ],
                'sabium_entity' => [
                    'class' => AnnotationDriver::class,
                    'cache' => 'array',
                    'paths' => [__DIR__ . '/Entity'],
                ],
            ],
        ];
    }


    /*
    public function getHalMetadataMap()
    {
        return [
            [
                '__class__' => RouteBasedResourceMetadata::class,
                'resource_class' => Announcement::class,
                'route' => 'announcements.view',
                'extractor' => ReflectionHydrator::class,
            ],
            [
                '__class__' => RouteBasedCollectionMetadata::class,
                'collection_class' => AnnouncementCollection::class,
                'collection_relation' => 'announcement',
                'route' => 'announcements.read',
            ],
        ];
    }
    */
}
