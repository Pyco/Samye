<?php

namespace Samye\EvtBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="Samye\EvtBundle\Entity\EventRepository")
 */
class Event
{
	/**
     * @ORM\ManyToOne(targetEntity="EvtCategory", inversedBy="events", cascade={"persist"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;
	
	/**
     * @ORM\ManyToOne(targetEntity="EvtStatus", inversedBy="events")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    private $status;
 
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeb", type="date")
     */
    private $dateDeb;
	
	 /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureDeb", type="time")
     */
	private $heureDeb;
	
	 /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureFin", type="time")
     */
	private $heureFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="duree", type="integer")
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255, nullable=true)
     */
    private $lieu;


 	public function __construct()
	{
		$this->dateDeb = new \Datetime;
		$this->duree = 1;
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
     * Set libelle
     *
     * @param string $libelle
     * @return Evenement
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
     * Set dateDeb
     *
     * @param \DateTime $dateDeb
     * @return Evenement
     */
    public function setDateDeb($dateDeb)
    {
        $this->dateDeb = $dateDeb;
    
        return $this;
    }

    /**
     * Get dateDeb
     *
     * @return \DateTime 
     */
    public function getDateDeb()
    {
        return $this->dateDeb;
    }

    /**
     * Set duree
     *
     * @param integer $duree
     * @return Evenement
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    
        return $this;
    }

    /**
     * Get duree
     *
     * @return integer 
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     * @return Evenement
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    
        return $this;
    }

    /**
     * Get lieu
     *
     * @return string 
     */
    public function getLieu()
    {
        return $this->lieu;
    }
	
	
	public function setHeureDeb($heureDeb)
	{
		$this->heureDeb = $heureDeb;
		return $this->heureDeb;
	}
	
	public function getHeureDeb()
	{
		return $this->heureDeb;
	}
	
	public function setHeureFin($heureFin)
	{
		$this->heureFin = $heureFin;

		return $this->heureFin;
	}
	
	public function getHeureFin()
	{
		return $this->heureFin;
	}

    /**
     * Set category
     *
     * @param \Samye\EvtBundle\Entity\EvtCategory $category
     * @return Event
     */
    public function setCategory(\Samye\EvtBundle\Entity\EvtCategory $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Samye\EvtBundle\Entity\EvtCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set status
     *
     * @param \Samye\EvtBundle\Entity\EvtStatus $status
     * @return Event
     */
    public function setStatus(\Samye\EvtBundle\Entity\EvtStatus $status = null)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return \Samye\EvtBundle\Entity\EvtStatus
     */
    public function getStatus()
    {
        return $this->status;
    }
}