<?php

namespace Sabium\Container;

use Psr\Container\ContainerInterface;

class ConnectionFactory
{
    public function __invoke(ContainerInterface $container): \PDO
    {
        $configSabiumDatabase = $container->get('config')['sabium'];
        return new \PDO(
            "pgsql:host=" . $configSabiumDatabase['host'] . ";port=" . $configSabiumDatabase['port'] .
                ";dbname=" . $configSabiumDatabase['database'],
            $configSabiumDatabase['user'],
            $configSabiumDatabase['pass'],
            [\PDO::ATTR_EMULATE_PREPARES => true]
        );
    }
}
