<?php
/**
 * Created by PhpStorm.
 * User: asuss
 * Date: 25/01/2017
 * Time: 12:43
 */

namespace Cov\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cov\UserBundle\Entity\User;
use Cov\ForumBundle\Entity\Categorie;

/**
 * @ORM\Entity
 * @ORM\Table(name="sujet")
 */
class Sujet
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",length=255)
     */

    private  $titre;

    /**
     * @ORM\Column(type="string",length=255)
     */

    private  $contenu;

    /**
     * @ORM\Column(type="datetime",length=255)
     */
    private $date;

    /**
     *
     * @ORM\OneToOne(targetEntity="Categorie")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     */
    private $categorie;

    /**
     *
     *  @ORM\OneToOne(targetEntity="Cov\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;





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
     * Set titre
     *
     * @param string $titre
     *
     * @return Sujet
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Sujet
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Sujet
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
     * Set categorie
     *
     * @param \Cov\ForumBundle\Entity\Categorie $categorie
     *
     * @return Sujet
     */
    public function setCategorie(\Cov\ForumBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Cov\ForumBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set user
     *
     * @param \Cov\UserBundle\Entity\User $user
     *
     * @return Sujet
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
