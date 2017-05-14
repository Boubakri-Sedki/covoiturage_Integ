<?php
/**
 * Created by PhpStorm.
 * User: asuss
 * Date: 19/02/2017
 * Time: 14:44
 */

namespace Cov\ChatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Cov\ChatBundle\Entity\MessageRepository")
 * @ORM\Table(name="message")
 */

class Message
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
     */
    protected $contenu;

    /**
     *
     *  @ORM\ManyToOne(targetEntity="Cov\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     *
     *  @ORM\ManyToOne(targetEntity="Cov\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user2_id", referencedColumnName="id")
     */
    private $user2;




    /**
     * @ORM\Column(type="datetime")
     *
     */
    protected $dateAjout;



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
     * @return Message
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
     * @return Message
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
     * Set user
     *
     * @param \Cov\UserBundle\Entity\User $user
     *
     * @return Message
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
     * Set user2
     *
     * @param \Cov\UserBundle\Entity\User $user2
     *
     * @return Message
     */
    public function setUser2(\Cov\UserBundle\Entity\User $user2 = null)
    {
        $this->user2 = $user2;

        return $this;
    }

    /**
     * Get user2
     *
     * @return \Cov\UserBundle\Entity\User
     */
    public function getUser2()
    {
        return $this->user2;
    }
}
