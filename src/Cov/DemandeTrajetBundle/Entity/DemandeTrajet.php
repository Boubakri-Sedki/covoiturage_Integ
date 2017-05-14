<?php
namespace Cov\DemandeTrajetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * DemandeTrajet
 *
 * @ORM\Table(name="demandetrajet")
 * @ORM\Entity(repositoryClass="Cov\DemandeTrajetBundle\Repository\DemandeTrajetRepository")
 */
class DemandeTrajet
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
     * @ORM\Column(name="date_ajout", type="datetime",options={"default"="CURRENT_TIMESTAMP"}, nullable=TRUE)
     */
    private $dateAjout ;

    /**
     * @var \DateTime
     * @Assert\GreaterThanOrEqual("today")
     * @Assert\LessThanOrEqual("15 days")
     * @ORM\Column(name="date_demandee", type="datetime")
     */
    private $dateDemandee;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_de_place", type="integer")
     */
    private $nombreDePlace;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_depart", type="string", length=255)
     */
    private $villeDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_arrive", type="string", length=255)
     */
    private $villeArrive;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Cov\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user",referencedColumnName="id")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * @param \DateTime $dateAjout
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }

    /**
     * @return \DateTime
     */
    public function getDateDemandee()
    {
        return $this->dateDemandee;
    }

    /**
     * @param \DateTime $dateDemandee
     */
    public function setDateDemandee($dateDemandee)
    {
        $this->dateDemandee = $dateDemandee;
    }

    /**
     * @return int
     */
    public function getNombreDePlace()
    {
        return $this->nombreDePlace;
    }

    /**
     * @param int $nombreDePlace
     */
    public function setNombreDePlace($nombreDePlace)
    {
        $this->nombreDePlace = $nombreDePlace;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getVilleDepart()
    {
        return $this->villeDepart;
    }

    /**
     * @param string $villeDepart
     */
    public function setVilleDepart($villeDepart)
    {
        $this->villeDepart = $villeDepart;
    }

    /**
     * @return string
     */
    public function getVilleArrive()
    {
        return $this->villeArrive;
    }

    /**
     * @param string $villeArrive
     */
    public function setVilleArrive($villeArrive)
    {
        $this->villeArrive = $villeArrive;
    }

    /**
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param int $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }
    
}