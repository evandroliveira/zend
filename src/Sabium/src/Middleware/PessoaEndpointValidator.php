<?php

declare(strict_types=1);

namespace Sabium\Middleware;

use Psr\Http\Message\ResponseInterface;
use Sabium\Repository\PessoaRepository;
use Psr\Http\Server\MiddlewareInterface;
use Zend\Diactoros\Response\EmptyResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class PessoaEndpointValidator implements MiddlewareInterface
{
    protected $pessoaRepository;
    public function __construct(PessoaRepository $pessoaRepository)
    {
            $this->pessoaRepository = $pessoaRepository;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $id = (int)$request->getAttribute('id');
        
        $pessoa = $this->pessoaRepository->findOneBy(['idcnpj_cpf' => $id]);
        
        if ($pessoa === null) {
            return new JsonResponse("Person not found", 404);
        }
        return $handler->handle($request->withAttribute('id', $id));
    }
}
