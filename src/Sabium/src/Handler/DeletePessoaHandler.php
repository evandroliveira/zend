<?php

declare (strict_types = 1);

namespace Sabium\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sabium\Repository\PessoaRepository;
use Zend\Diactoros\Response\TextResponse;

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
        if (!empty($id)) {
            $result = $this->repository->deleteById($id);
        } else {
            $result = $this->repository->deleteAll();
        }

        return new TextResponse(
            $this->serializer->serialize($result, 'json'),
            200,
            ['Content-Type' => ['application/json']]
        );
    }
}
