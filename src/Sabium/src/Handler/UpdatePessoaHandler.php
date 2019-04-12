<?php

declare (strict_types = 1);

namespace Sabium\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sabium\Repository\PessoaRepository;
use Zend\Diactoros\Response\TextResponse;
use Sabium\Entity\Pessoa;
use Zend\Diactoros\Response\JsonResponse;

class UpdatePessoaHandler implements RequestHandlerInterface
{
    public function __construct(PessoaRepository $repository, $serializer)
    {
        $this->repository = $repository;
        $this->serializer = $serializer;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $dados = $request->getAttribute(Pessoa::class);

        $retorno = $this->repository->updateById($dados);

        return new JsonResponse('OK');
    }
}
