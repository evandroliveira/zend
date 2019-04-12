<?php

namespace Sabium\Container;

use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

class MonologFactory
{
   public function __invoke(ContainerInterface $container)
   {
       $data = \Date('Y-m-d');
       $dateFormat = "Y/m/d, H:s";
       $output = "%datetime% > %level_name% \n %message%";
       $formatter = new LineFormatter($output, $dateFormat, true);

       $logger = new Logger('Logs');
       $stream = new StreamHandler(__DIR__.'/../../../../data/log/'.date('Y-m-d').'.log');
       $stream->setFormatter($formatter);
       $logger->pushHandler($stream);
       return $logger;
   }
}