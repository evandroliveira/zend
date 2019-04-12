<?php

namespace Sabium\Repository;

use Doctrine\ORM\EntityRepository;
use Sabium\Entity\Pessoa;
use PHPUnit\Runner\Exception;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class PessoaRepository extends EntityRepository
{

    public function insert(Pessoa $pessoa)
    {
        $em = $this->getEntityManager();
        $em->persist($pessoa);
        $em->flush();
        return $pessoa;
    }

    public function getIdade(Idade $idade) 
    {
        try {
            $em = $this->getEntityManager();
            $dataNascimento = $em->getRepository(Pessoa::class)->findBy(['datacriacao' => $idade->getDatacriacao()]);
            $date = new Date('Y-m-a');
            if (!empty($dataNascimento)) {
                $result = $date - $dataNascimento;
                $em->merge($idade);
                $em->flush();
                return $result;
            }

        } catch (Exceptioin $e) {  }
    }

    public function getLog()
    {
        $stream = new StreamHandler(__DIR__.'/logger.log', Logger::DEBUG);
        $firephp = new FirePHPHandler();

        // Create the main logger of the app
        $logger = new Logger('my_logger');
        $logger->pushHandler($stream);
        $logger->pushHandler($firephp);

// Create a logger for the security-related stuff with a different channel
        $securityLogger = new Logger('security');
        $securityLogger->pushHandler($stream);
        $securityLogger->pushHandler($firephp);

        // Or clone the first one to only change the channel
        $securityLogger = $logger->withName('security');

        $data = date("d-m-y");
        $hora = date("H:i:s");
        $ip = $_SERVER['REMOTE_ADDR'];

        //Nome do arquivo:
        $arquivo = "Logger_$data.txt";

        //Texto a ser impresso no log:
        $texto = "[$hora][$ip]> $msg \n";

        $manipular = fopen("$arquivo", "a+b");
        fwrite($manipular, $texto);
        fclose($manipular);
    }

    public function updateById(Pessoa $pessoa)
    {
        try {
            $em = $this->getEntityManager();
            $pessoaOld = $em->getRepository(Pessoa::class)->findOneBy(['idcnpj_cpf' => $pessoa->getIdCnpjCpf()]);
            if (!empty($pessoaOld)) {
                $em->merge($pessoa);
                $em->flush();
                return $pessoa;
            }
        } catch (Exception $e) { }
    }

    public function deleteById($idcnpj_cpf)
    {
        try {
            $em = $this->getEntityManager();
            $pessoa = $em->getRepository(Pessoa::class)->findOneBy(['idcnpj_cpf' => $idcnpj_cpf]);
            $em->remove($pessoa);
            $em->flush();
            return "Registro com ID ($idcnpj_cpf) deletado com sucesso!";
        } catch (Exception $e) { }
    }

    /*public function deleteAll()
    {
        try {
            $em = $this->getEntityManager();
            $pessoas = $this->findAll();
            foreach ($pessoas as $pessoa) {
                $em->remove($pessoa);
            }
            $em->flush();
            return "Registros deletados!";
        } catch (Exception $e) { }
    }*/

    public function findById($idcnpj_cpf)
    {
        $em = $this->getEntityManager();
       
        return $em->getRepository(Pessoa::class)->findBy(array('idcnpj_cpf' => $idcnpj_cpf));
    }

    public function findAll()
    {
        $em = $this->getEntityManager();
        return $em->getRepository(Pessoa::class)->findBy(array(), array('idcnpj_cpf' => 'ASC'));
    }

    public function findBySituation($situation)
    {
        $em = $this->getEntityManager();
        return $em->getRepository(Pessoa::class)->findBy(array('idsituacaopessoa' => $situation));
    }
}
