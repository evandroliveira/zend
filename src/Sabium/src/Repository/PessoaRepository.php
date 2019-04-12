<?php

namespace Sabium\Repository;

use Doctrine\ORM\EntityRepository;
use Sabium\Entity\Pessoa;
use PHPUnit\Runner\Exception;

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
