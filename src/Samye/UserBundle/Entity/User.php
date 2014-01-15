<?php

namespace Samye\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User  extends BaseUser
{
	/**
     * @ORM\OneToMany(targetEntity="Samye\EvtBundle\Entity\Event", mappedBy="auhtor")
     */
	 protected $events;
	 
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	
		
	/**
	 * @var string
	 * @ORM\Column(name="userType", type="string", length=255)
	 */
	 
	protected $userType;

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
     * @return User
     */
    public function addEvent(\Samye\EvtBundle\Entity\Event $events)
    {
        $this->events[] = $events;

	}
    
    
    /**
     * Set userType
     *
     * @param string $userType
     * @return User
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;

    
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

     /* Get userType
     *
     * @return string 
     */
    public function getUserType()
    {
        return $this->userType;
    }

    

}