<?php

namespace Samye\EvtBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * EvtCategory
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Samye\EvtBundle\Entity\EvtCategoryRepository")
 */
class EvtCategory
{
	
	/**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="evtCategory")
     */
	 protected $events;
	 
	 public function _construct()
	 {
		 $this->events = new ArrayCollection();
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
     * @return EvtCategory
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
     * Constructor
     */
    public function __construct()
    {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add events
     *
     * @param \Samye\EvtBundle\Entity\Event $events
     * @return EvtCategory
     */
    public function addEvent(\Samye\EvtBundle\Entity\Event $events)
    {
        $this->events[] = $events;
    
        return $this;
    }

    /**
     * Remove events
     *
     * @param \Samye\EvtBundle\Entity\Event $events
     */
    public function removeEvent(\Samye\EvtBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }
}