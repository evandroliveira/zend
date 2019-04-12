<?php

declare (strict_types = 1);

namespace Sabium\Handler;

use Sabium\Entity\Pessoa;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sabium\Repository\PessoaRepository;

class CreatePessoaHandler implements RequestHandlerInterface
{
    public function __construct($repository, $serializer)
    {
        $this->repository = $repository;
        $this->serializer = $serializer;

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $dados = $request->getAttribute(Pessoa::class);             
        $retorno = $this->repository->insert($dados);   

        return new JsonResponse('Inserido com sucesso!');

    }
}
