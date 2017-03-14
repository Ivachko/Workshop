<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="Nombre_Personne", type="integer")
     */
    private $nombrePersonne;

    /**
     * @var int
     *
     * @ORM\Column(name="Num_CB", type="integer")
     */
    private $numCB;

    /**
     * @var int
     *
     * @ORM\Column(name="CCV", type="integer")
     */
    private $cCV;

    /**
     * @var string
     *
     * @ORM\Column(name="Date_Validite", type="string", length=255)
     */
    private $dateValidite;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Reservation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set nombrePersonne
     *
     * @param integer $nombrePersonne
     *
     * @return Reservation
     */
    public function setNombrePersonne($nombrePersonne)
    {
        $this->nombrePersonne = $nombrePersonne;

        return $this;
    }

    /**
     * Get nombrePersonne
     *
     * @return int
     */
    public function getNombrePersonne()
    {
        return $this->nombrePersonne;
    }

    /**
     * Set numCB
     *
     * @param integer $numCB
     *
     * @return Reservation
     */
    public function setNumCB($numCB)
    {
        $this->numCB = $numCB;

        return $this;
    }

    /**
     * Get numCB
     *
     * @return int
     */
    public function getNumCB()
    {
        return $this->numCB;
    }

    /**
     * Set cCV
     *
     * @param integer $cCV
     *
     * @return Reservation
     */
    public function setCCV($cCV)
    {
        $this->cCV = $cCV;

        return $this;
    }

    /**
     * Get cCV
     *
     * @return int
     */
    public function getCCV()
    {
        return $this->cCV;
    }

    /**
     * Set dateValidite
     *
     * @param string $dateValidite
     *
     * @return Reservation
     */
    public function setDateValidite($dateValidite)
    {
        $this->dateValidite = $dateValidite;

        return $this;
    }

    /**
     * Get dateValidite
     *
     * @return string
     */
    public function getDateValidite()
    {
        return $this->dateValidite;
    }
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Users",inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */

    private $user;

    /**
     * Set user
     *
     * @param \AppBundle\Entity\Users $user
     *
     * @return Reservation
     */
    public function setUser(\AppBundle\Entity\Users $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Restaurant")
     * @ORM\JoinColumn(nullable=true)
     *
     */
    private $restaurant;

    /**
     * Set restaurant
     *
     * @param \AppBundle\Entity\Restaurant $restaurant
     *
     * @return Reservation
     */
    public function setRestaurant(\AppBundle\Entity\Restaurant $restaurant = null)
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * Get restaurant
     *
     * @return \AppBundle\Entity\Restaurant
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Activite")
     * @ORM\JoinColumn(nullable=true)
     *
     */
    private $actvite;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Pack_Activite")
     * @ORM\JoinColumn(nullable=true)
     *
     */
    private $pack_actvite;


    /**
     * Set actvite
     *
     * @param \AppBundle\Entity\Activite $actvite
     *
     * @return Reservation
     */
    public function setActvite(\AppBundle\Entity\Activite $actvite = null)
    {
        $this->actvite = $actvite;

        return $this;
    }

    /**
     * Get actvite
     *
     * @return \AppBundle\Entity\Activite
     */
    public function getActvite()
    {
        return $this->actvite;
    }

    /**
     * Set packActvite
     *
     * @param \AppBundle\Entity\Pack_Activite $packActvite
     *
     * @return Reservation
     */
    public function setPackActvite(\AppBundle\Entity\Pack_Activite $packActvite = null)
    {
        $this->pack_actvite = $packActvite;

        return $this;
    }

    /**
     * Get packActvite
     *
     * @return \AppBundle\Entity\Pack_Activite
     */
    public function getPackActvite()
    {
        return $this->pack_actvite;
    }
}
