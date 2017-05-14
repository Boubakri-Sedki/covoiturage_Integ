<?php
/**
 * Created by PhpStorm.
 * User: asuss
 * Date: 31/01/2017
 * Time: 18:12
 */

namespace Cov\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="ville")
 */

class Ville
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Length(
     *     min=3,
     *     max=15,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long."
     *
     * )
     */
    protected $name;

    /**
     *
     *  @ORM\ManyToOne(targetEntity="Cov\UserBundle\Entity\Gouvernorat" , inversedBy="Ville")
     * @ORM\JoinColumn(name="gouvernorat_id", referencedColumnName="id")
     */
    private $gouvernorat;



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
     * Set name
     *
     * @param string $name
     *
     * @return Ville
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set gouvernorat
     *
     * @param \Cov\UserBundle\Entity\Gouvernorat $gouvernorat
     *
     * @return Ville
     */
    public function setGouvernorat(\Cov\UserBundle\Entity\Gouvernorat $gouvernorat = null)
    {
        $this->gouvernorat = $gouvernorat;

        return $this;
    }

    /**
     * Get gouvernorat
     *
     * @return \Cov\UserBundle\Entity\Gouvernorat
     */
    public function getGouvernorat()
    {
        return $this->gouvernorat;
    }
}
