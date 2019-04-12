<?php

declare(strict_types=1);

namespace Sabium\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MonologMiddleware implements MiddlewareInterface
{
    protected $retoron;
    public function __construct($logger)
    {
        $this->logger = $logger;       
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        // $response = $handler->handle($request);
        $retorno = $handler->handle($request);

        $this->logger->info(sprintf(
            "\nclient: %s \nuri: %s [%s]\nstatusCode: %s\nbody: %s",
            $request->getServerParams()['REMOTE_ADDR'],
            $request->getServerParams()['HTTP_HOST'],
            $request->getServerParams()['REQUEST_URI'],
            $request->getMethod(),
            $retorno->getStatusCode(),
            $request->getBody()->getContents()
        ));

        return $retorno;
    }
}
