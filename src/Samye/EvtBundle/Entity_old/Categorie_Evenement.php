<?php

namespace Samye\EvtBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Categorie_Evenement
 *
 * @ORM\Table(name="categorie_evenement")
 * @ORM\Entity(repositoryClass="Samye\EvtBundle\Entity\Categorie_EvenementRepository")
 */
class Categorie_Evenement
{
	
	/**
     * @ORM\OneToMany(targetEntity="Evenement", mappedBy="categorie_evenement")
     */
    protected $evenements;
	
	public function __construct()
    {
        $this->evenements = new ArrayCollection();
    }
	
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;


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
     * Set libelle
     *
     * @param string $libelle
     * @return Categorie_Evenement
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Add evenements
     *
     * @param \Samye\EvtBundle\Entity\Evenement $evenements
     * @return Categorie_Evenement
     */
    public function addEvenement(\Samye\EvtBundle\Entity\Evenement $evenements)
    {
        $this->evenements[] = $evenements;
    
        return $this;
    }

    /**
     * Remove evenements
     *
     * @param \Samye\EvtBundle\Entity\Evenement $evenements
     */
    public function removeEvenement(\Samye\EvtBundle\Entity\Evenement $evenements)
    {
        $this->evenements->removeElement($evenements);
    }

    /**
     * Get evenements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvenements()
    {
        return $this->evenements;
    }
}