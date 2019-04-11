<?php

declare (strict_types = 1);

namespace Sabium\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sabium\Repository\PessoaRepository;
use Zend\Diactoros\Response\TextResponse;
use Sabium\Entity\Pessoa;

class UpdatePessoaHandler implements RequestHandlerInterface
{
    public function __construct(PessoaRepository $repository, $serializer)
    {
        $this->repository = $repository;
        $this->serializer = $serializer;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $resultBody = $this->serializer->deserialize($request->getBody()->getContents(), Pessoa::class, 'json');
        $result = $this->repository->updateById($resultBody);

        return new TextResponse(
            $this->serializer->serialize($result, 'json'),
            200,
            ['Content-Type' => ['application/json']]
        );
    }
}
