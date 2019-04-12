<?php

declare(strict_types=1);

namespace Sabium\Middleware;

use Psr\Container\ContainerInterface;
use Sabium\Container\MonologFactory;

class MonologMiddlewareFactory
{
   public function __invoke(ContainerInterface $container) : MonologMiddleware
   {
       $monolog = $container->get(MonologFactory::class);
       return new MonologMiddleware($monolog);
   }
}
