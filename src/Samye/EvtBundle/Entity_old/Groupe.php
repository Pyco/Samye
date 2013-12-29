<?php

namespace Samye\EvtBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Groupe
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Samye\EvtBundle\Entity\GroupeRepository")
 */
class Groupe
{
	
	/**
     * @ORM\OneToMany(targetEntity="Membre", mappedBy="groupe")
     */
    protected $membres;
	
	/**
     * @ORM\OneToMany(targetEntity="Evenement", mappedBy="groupe")
     */
    protected $evenements;
	
	public function __construct()
    {
        $this->membres = new ArrayCollection();
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add membres
     *
     * @param \Samye\EvtBundle\Entity\Membre $membres
     * @return Groupe
     */
    public function addMembre(\Samye\EvtBundle\Entity\Membre $membres)
    {
        $this->membres[] = $membres;
    
        return $this;
    }

    /**
     * Remove membres
     *
     * @param \Samye\EvtBundle\Entity\Membre $membres
     */
    public function removeMembre(\Samye\EvtBundle\Entity\Membre $membres)
    {
        $this->membres->removeElement($membres);
    }

    /**
     * Get membres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMembres()
    {
        return $this->membres;
    }

    /**
     * Add evenements
     *
     * @param \Samye\EvtBundle\Entity\Evenement $evenements
     * @return Groupe
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