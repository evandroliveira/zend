<?php

declare (strict_types = 1);

namespace Sabium\Handler;

use Psr\Http\Message\ResponseInterface;
use Sabium\Repository\PessoaRepository;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\TextResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DeletePessoaHandler implements RequestHandlerInterface
{
    public function __construct(PessoaRepository $repository, $serializer)
    {
        $this->repository = $repository;
        $this->serializer = $serializer;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $result = $this->repository->deleteById($id);
        return new JsonResponse('Person deleted');
    }
}
