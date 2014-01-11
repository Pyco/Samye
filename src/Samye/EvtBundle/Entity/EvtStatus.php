<?php

namespace Samye\EvtBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * EvtStatus
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Samye\EvtBundle\Entity\EvtStatusRepository")
 */
class EvtStatus
{
	
	 /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="evtStatus")
     */
	 protected $events;
	 
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
     * @return EvtStatus
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
     * @return EvtStatus
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