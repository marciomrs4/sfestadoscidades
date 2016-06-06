<?php

namespace Mrs\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mrs\BlogBundle\Entity\Cidades;
use Mrs\BlogBundle\Entity\Estados;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="idade", type="string", length=255)
     */
    private $idade;

    /**
     * @var \Mrs\BlogBundle\Entity\Cidades
     *
     * @ORM\Column(name="cidade")
     */
    private $cidade;

    /**
     * @var \Mrs\BlogBundle\Entity\Estados
     *
     * @ORM\Column(name="estado")
     */
    private $estado;


    public function __construct()
    {
        //$this->estado = new \Doctrine\Common\Collections\ArrayCollection;
       // $this->cidades = new \Doctrine\Common\Collections\ArrayCollection;
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
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set idade
     *
     * @param string $idade
     * @return User
     */
    public function setIdade($idade)
    {
        $this->idade = $idade;

        return $this;
    }

    /**
     * Get idade
     *
     * @return string 
     */
    public function getIdade()
    {
        return $this->idade;
    }

    /**
     * Set cidade
     *
     * @param \stdClass $cidade
     * @return User
     */
    public function setCidade(Cidades $cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get cidade
     *
     * @return \stdClass 
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set estado
     *
     * @param \stdClass $estado
     * @return User
     */
    public function setEstado(Estados $estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \stdClass 
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
