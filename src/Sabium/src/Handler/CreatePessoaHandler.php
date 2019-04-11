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

class CreatePessoaHandler implements RequestHandlerInterface
{
    public function __construct(PessoaRepository $repository, $serializer, $validation, $objectValidator)
    {
        $this->repository = $repository;
        $this->serializer = $serializer;
        $this->validation = $validation;
        $this->objectValidator = $objectValidator;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $resultBody = $this->serializer->deserialize($request->getBody()->getContents(), Pessoa::class, 'json');

        if (!$this->objectValidator->validate($resultBody)) {
            return new JsonResponse($this->objectValidator->getErrors(), 400);
        }
        $result = $this->repository->insert($resultBody);
        return $this->response($result, 200);
    }

    private function response($result, $code): ResponseInterface
    {
        return new TextResponse(
            $this->serializer->serialize($result, 'json'),
            $code,
            ['Content-Type' => ['application/json']]
        );
    }
}













 /*
        //$result = $this->repository->findBySituation($request->getAttribute('idsituacao'));

        return new TextResponse(
            $this->serializer->serialize($result, 'xml'),
            200,
            ['Content-Type' => ['application/xhtml+xml']]
        );
        */
        /*     
        /*try {
            $result = $this->repository->insert($this->jsonMapper->map(json_decode($request->getBody()->getContents()), new Pessoa()));
            return $result != null ? new JsonResponse($result) : new EmptyResponse(404);
        } catch (RepositoryPDOException $e) {
            return new EmptyResponse(500);
        }*/



    /*
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $result =  $this->jsonMapper->map(json_decode($request->getBody()->getContents()), new Pessoa());

        try {
            $validator = new ValidatorMapper($result, $this->repository);
            var_dump($validator = new ValidatorMapper($result, $this->repository));
            return  $validator->isValid() ? $this->insert($result) : new EmptyResponse(400);
        } catch (RepositoryPDOException $e) {
            return new EmptyResponse(500);
        }
    }

    private function insert($result)
    {
        $pessoa = $this->repository->insert($result);
        return new JsonResponse($pessoa);
    }*/
