<?php

namespace Sabium\Container;

use Psr\Container\ContainerInterface;

class JSONMapperFactory
{
    public function __invoke(ContainerInterface $container) : \JsonMapper
    {
        return new \JsonMapper();
    }
}
