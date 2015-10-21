<?php

namespace Mrs\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Estados
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Estados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255)
     * @Assert\NotBlank(message="Por favor insira um valor")
     * @Assert\Length(min=6, minMessage="Quantidade de caracteres invalidao")
     */
    private $descricao;

    /**
     * @var string
     *
     * @ORM\Column(name="numerohabitantes", type="string", length=255)
     * @Assert\Length(min=5, minMessage="por favor use 5 ou mais (criacao) ", groups={"criacao"})
     * @Assert\Length(min=10, minMessage="por favor use 10 ou mais (atualizacao) ", groups={"atualizacao"})
     * @Assert\Type(
     *      type="integer",
     *      message="Esse valor deve ser numerico"
     * )
     */
    private $numerohabitantes;
    
    /**
     *
     * @var integer
     * @ORM\OneToMany(targetEntity="Cidades", mappedBy="Estados") 
     */
    private $cidades;
    
    public function __construct() 
    {
        $this->cidades = new \Doctrine\Common\Collections\ArrayCollection;
    }

        /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     * @return Estados
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string 
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set numerohabitantes
     *
     * @param string $numerohabitantes
     * @return Estados
     */
    public function setNumerohabitantes($numerohabitantes)
    {
        $this->numerohabitantes = $numerohabitantes;

        return $this;
    }

    /**
     * Get numerohabitantes
     *
     * @return string 
     */
    public function getNumerohabitantes()
    {
        return $this->numerohabitantes;
    }

    /**
     * Add cidades
     *
     * @param \Mrs\BlogBundle\Entity\Cidades $cidades
     * @return Estados
     */
    public function addCidade(\Mrs\BlogBundle\Entity\Cidades $cidades)
    {
        $this->cidades[] = $cidades;

        return $this;
    }

    /**
     * Remove cidades
     *
     * @param \Mrs\BlogBundle\Entity\Cidades $cidades
     */
    public function removeCidade(\Mrs\BlogBundle\Entity\Cidades $cidades)
    {
        $this->cidades->removeElement($cidades);
    }

    /**
     * Get cidades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCidades()
    {
        return $this->cidades;
    }
    
    public function __toString() 
    {
        return $this->getDescricao();
    }
}
