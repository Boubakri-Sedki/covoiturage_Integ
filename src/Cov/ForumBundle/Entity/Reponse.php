<?php
/**
 * Created by PhpStorm.
 * User: asuss
 * Date: 25/01/2017
 * Time: 13:51
 */

namespace Cov\ForumBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Cov\UserBundle\Entity\User;
use Cov\ForumBundle\Entity\Sujet;

/**
 * @ORM\Entity
 * @ORM\Table(name="reponse")
 */

class Reponse
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

    private  $contenu;

    /**
     * @ORM\Column(type="datetime",length=255)
     */
    private $date;

    /**
     *
     *  @ORM\OneToOne(targetEntity="Cov\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     *
     * @ORM\OneToOne(targetEntity="Sujet")
     * @ORM\JoinColumn(name="sujet_id", referencedColumnName="id")
     */
    private $sujet;


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
     * @return Reponse
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
     * @return Reponse
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
     * Set user
     *
     * @param \Cov\UserBundle\Entity\User $user
     *
     * @return Reponse
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

    /**
     * Set sujet
     *
     * @param \Cov\ForumBundle\Entity\Sujet $sujet
     *
     * @return Reponse
     */
    public function setSujet(\Cov\ForumBundle\Entity\Sujet $sujet = null)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet
     *
     * @return \Cov\ForumBundle\Entity\Sujet
     */
    public function getSujet()
    {
        return $this->sujet;
    }
}
