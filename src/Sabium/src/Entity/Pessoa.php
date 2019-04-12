<?php

declare (strict_types = 1);

namespace Sabium\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Glb.pessoa
 *
 * @ORM\Table(name="glb.pessoa")
 * @ORM\Entity(repositoryClass="Sabium\Repository\PessoaRepository")
 */
class Pessoa
{
    /**
     * @Type("int")
     * 
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")   
     * @ORM\Column(name="idcnpj_cpf", type="bigint", nullable=false)  
     * @Assert\NotBlank(message="O IDCNPJ_CPF é obrigatório!")
     */
    private $idcnpj_cpf;

    /**
     * @var int|null
     * @Type("int")
     * @ORM\Column(name="idtipopessoa", type="integer", nullable=true)
     * 
     */
    private $idtipopessoa;

    /**
     * @var int|null
     * @Type("int")
     * @ORM\Column(name="idsituacaopessoa", type="integer", nullable=true)
     * 
     */
    private $idsituacaopessoa;

    /**
     * @var int|null
     * @Type("int")
     * @ORM\Column(name="idtiposexo", type="integer", nullable=true)
     */
    private $idtiposexo;

    /**
     * @var string|null
     * @Type("string")
     * @ORM\Column(name="cnpj_cpf", type="string", length=14, nullable=true)     
     */
    private $cnpjCpf;

    /**
     * @var string
     * @Type("string")
     * @ORM\Column(name="nome", type="string", length=100, nullable=false)
     * @Assert\NotBlank(message="O NOME é obrigatório!")
     */
    private $nome;

    /**
     * @var string|null
     * @Type("string") 
     * @ORM\Column(name="cce_rg", type="string", length=100, nullable=true)
     */
    private $cceRg;

    /**
    * @var \DateTime|null
    * @Type("DateTime<'Y-m-d'>")
    * @Assert\NotBlank(message="Data de criação é obrigatório")
    * @ORM\Column(name="datacriacao", type="date", nullable=true)
    */
    private $datacriacao;

    
    public function getIdCnpjCpf()
    {
        return $this->idcnpj_cpf;
    }


    public function setIdCnpjCpf($idcnpj_cpf)
    {
        $this->idcnpj_cpf = $idcnpj_cpf;

        return $this;
    }

    public function getIdtipopessoa()
    {
        return $this->idtipopessoa;
    }

    public function setIdtipopessoa($idtipopessoa)
    {
        $this->idtipopessoa = $idtipopessoa;

        return $this;
    }

    public function getIdsituacaopessoa()
    {
        return $this->idsituacaopessoa;
    }

    public function setIdsituacaopessoa($idsituacaopessoa)
    {
        $this->idsituacaopessoa = $idsituacaopessoa;

        return $this;
    }

    public function getIdtiposexo()
    {
        return $this->idtiposexo;
    }

    public function setIdtiposexo($idtiposexo)
    {
        $this->idtiposexo = $idtiposexo;

        return $this;
    }

    public function getCnpjCpf()
    {
        return $this->cnpjCpf;
    }

    public function setCnpjCpf($cnpjCpf)
    {
        $this->cnpjCpf = $cnpjCpf;

        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function getCceRg()
    {
        return $this->cceRg;
    }

    public function setCceRg($cceRg)
    {
        $this->cceRg = $cceRg;

        return $this;
    }

    public function getDatacriacao()
    {
        return $this->datacriacao;
    }

    public function setDatacriacao($datacriacao)
    {
        $this->datacriacao = $datacriacao;

        return $this;
    }
}
