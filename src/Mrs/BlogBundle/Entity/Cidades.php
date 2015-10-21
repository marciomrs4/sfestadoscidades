<?php

namespace Mrs\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cidades
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mrs\BlogBundle\Repository\CidadesRepository")
 */
class Cidades
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
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="prefeito", type="string", length=200)
     */
    private $prefeito;

    /**
     *
     * @var integer
     * @ORM\ManyToOne(targetEntity="Estados", inversedBy="cidades")
     * @ORM\JoinColumn(name="estados_id", referencedColumnName="id") 
     */
    private $estados_id;
    

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
     * Set nome
     *
     * @param string $nome
     * @return Cidades
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set prefeito
     *
     * @param string $prefeito
     * @return Cidades
     */
    public function setPrefeito($prefeito)
    {
        $this->prefeito = $prefeito;

        return $this;
    }

    /**
     * Get prefeito
     *
     * @return string 
     */
    public function getPrefeito()
    {
        return $this->prefeito;
    }

    /**
     * Set estados_id
     *
     * @param \Mrs\BlogBundle\Entity\Estados $estadosId
     * @return Cidades
     */
    public function setEstadosId(\Mrs\BlogBundle\Entity\Estados $estadosId = null)
    {
        $this->estados_id = $estadosId;

        return $this;
    }

    /**
     * Get estados_id
     *
     * @return \Mrs\BlogBundle\Entity\Estados 
     */
    public function getEstadosId()
    {
        return $this->estados_id;
    }
    
    public function __toString() 
    {
    	return $this->getNome();
    }
    
}
