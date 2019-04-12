<?php

declare (strict_types = 1);

namespace Sabium\Handler;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sabium\Repository\PessoaRepository;
use Zend\Diactoros\Response\TextResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\EmptyResponse;

class RetrievePessoaHandler implements RequestHandlerInterface
{
    protected $repository;
    protected $serializer;
    public function __construct(PessoaRepository $repository, $serializer)
    {
        $this->repository = $repository;
        $this->serializer = $serializer;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = (int)$request->getAttribute('id');
        
        if (!empty($id)) {
            $result = $this->repository->findById($id);
            return new TextResponse(
                $this->serializer->serialize($result, 'json'),
                200,
                ['Content-Type' => ['application/json']]
            );
        }
        
        return new EmptyResponse(400);
        /*else {
            $result = $this->repository->findAll();
        }
       /* */

    }
}
