<?php
/**
 * Created by PhpStorm.
 * User: asuss
 * Date: 08/02/2017
 * Time: 20:47
 */

namespace Cov\TemoignageBundle\Entity;

use FOS\UserBundle\Model\Temoignage as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\UserInterface;


/**
 * @ORM\Table(name="temoignage")
 * @ORM\Entity(repositoryClass="Cov\TemoignageBundle\Entity\TemoignageRepository")
 */

class Temoignage
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="SVP Entrer votre témoignage")
     * @Assert\Length(
     *     min=10,
     *     max=2255,
     *     minMessage="Le contenu est trop court.",
     *     maxMessage="Le contenu est trop long."
     *
     * )
     */
    protected $contenu;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    protected $dateAjout;

    /**
     *
     *  @ORM\ManyToOne(targetEntity="Cov\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    protected $dateValidation;

    /**
     * @ORM\Column(type="integer")
     */

    private  $statut=0;






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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Temoignage
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     *
     * @return Temoignage
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * Set dateValidation
     *
     * @param \DateTime $dateValidation
     *
     * @return Temoignage
     */
    public function setDateValidation($dateValidation)
    {
        $this->dateValidation = $dateValidation;

        return $this;
    }

    /**
     * Get dateValidation
     *
     * @return \DateTime
     */
    public function getDateValidation()
    {
        return $this->dateValidation;
    }

    /**
     * Set statut
     *
     * @param boolean $statut
     *
     * @return Temoignage
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return boolean
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set user
     *
     * @param \Cov\UserBundle\Entity\User $user
     *
     * @return Temoignage
     */
    public function setUser(\Cov\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Cov\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
