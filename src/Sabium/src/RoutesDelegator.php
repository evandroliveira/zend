<?php

declare (strict_types = 1);

namespace Sabium;

use Zend\Expressive\Application;
use Psr\Container\ContainerInterface;
use Sabium\Handler\CreatePessoaHandler;
use Sabium\Handler\UpdatePessoaHandler;
use Sabium\Handler\RetrievePessoaHandler;
use Sabium\Middleware\PessoaEndpointValidator;
use Sabium\Middleware\PessoaBodyValidator;

class RoutesDelegator
{
    public function __invoke(ContainerInterface $containerInterface, $serviceName, callable $callBack): Application
    {
        $app = $callBack();
        $app->post('/pessoas', [PessoaBodyValidator::class, CreatePessoaHandler::class], 'pessoas.insert');
        $app->put('/pessoas', [PessoaBodyValidator::class, UpdatePessoaHandler::class], 'pessoas.update');
        $app->get('/situacoes/{id:\d+}/pessoas', \Sabium\Handler\RetrievePessoaHandler::class, 'pessoas-situacao.find');
        $app->get('/pessoas/{id:\d+}', [PessoaEndpointValidator::class,
                                    RetrievePessoaHandler::class], 'pessoas.find');
        $app->get('/pessoas/all', \Sabium\Handler\RetrievePessoaHandler::class, 'pessoas.findAll');
        $app->delete('/pessoas/{id:\d+}', [PessoaEndpointValidator::class, \Sabium\Handler\DeletePessoaHandler::class], 'pessoas.delete');
        $app->delete('/pessoas/all', \Sabium\Handler\DeletePessoaHandler::class, 'pessoas.deleteAll');
        $app->get('/pessoas/{cnpj}/idade', \Sabium\Handler\RetriveIdadePessoa::class, 'pessoas.idade');
        return $app;
    }
}
