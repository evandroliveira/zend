<?php

declare(strict_types=1);

namespace Sabium\Middleware;

use Sabium\Entity\Pessoa;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class PessoaBodyValidator implements MiddlewareInterface
{
    protected $serializer;
    protected $validation;
    protected $objectValidator;

    public function __construct($serializer, $validation, $objectValidator)
    {
        $this->serializer = $serializer;
        $this->validation = $validation;
        $this->objectValidator = $objectValidator;

    }
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        // $response = $handler->handle($request);
        
        $dados = $request->getBody()->getContents();
        $object = $this->serializer->deserialize($dados, Pessoa::class, 'json');   

        $validation = $this->objectValidator->validate($object);

        if (!$validation) {
            return new JsonResponse($this->objectValidator->getErrors(), 400);
        }
        return $handler->handle($request->withAttribute(Pessoa::class, $object));


    }
}
