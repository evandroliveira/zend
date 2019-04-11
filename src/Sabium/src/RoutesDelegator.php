<?php

declare (strict_types = 1);

namespace Sabium;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;

class RoutesDelegator
{
    public function __invoke(ContainerInterface $containerInterface, $serviceName, callable $callBack): Application
    {
        $app = $callBack();
        $app->post('/pessoas', \Sabium\Handler\CreatePessoaHandler::class, 'pessoas.insert');
        $app->put('/pessoas/{id:\d+}', \Sabium\Handler\UpdatePessoaHandler::class, 'pessoas.update');
        $app->get('/situacoes/{id:\d+}/pessoas', \Sabium\Handler\RetrievePessoaHandler::class, 'pessoas-situacao.find');
        $app->get('/pessoas/{id:\d+}', \Sabium\Handler\RetrievePessoaHandler::class, 'pessoas.find');
        $app->get('/pessoas/all', \Sabium\Handler\RetrievePessoaHandler::class, 'pessoas.findAll');
        $app->delete('/pessoas/{id:\d+}', \Sabium\Handler\DeletePessoaHandler::class, 'pessoas.delete');
        $app->delete('/pessoas/all', \Sabium\Handler\DeletePessoaHandler::class, 'pessoas.deleteAll');
        $app->get('/pessoas/{cnpj}/idade', \Sabium\Handler\RetriveIdadePessoa::class, 'pessoas.idade');
        return $app;
    }
}
