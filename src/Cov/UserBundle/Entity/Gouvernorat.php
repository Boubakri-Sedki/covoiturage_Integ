<?php
/**
 * Created by PhpStorm.
 * User: asuss
 * Date: 30/01/2017
 * Time: 22:44
 */

namespace Cov\UserBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity
 * @ORM\Table(name="gouvernorat")
 */
class Gouvernorat
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
     *  @ORM\OneToMany(targetEntity="Cov\UserBundle\Entity\Ville" , mappedBy="Gouvernorat")
     */
    private $ville;


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
     * @return Gouvernorat
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
     * Constructor
     */
    public function __construct()
    {
        $this->ville = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ville
     *
     * @param \Cov\UserBundle\Entity\Ville $ville
     *
     * @return Gouvernorat
     */
    public function addVille(\Cov\UserBundle\Entity\Ville $ville)
    {
        $this->ville[] = $ville;

        return $this;
    }

    /**
     * Remove ville
     *
     * @param \Cov\UserBundle\Entity\Ville $ville
     */
    public function removeVille(\Cov\UserBundle\Entity\Ville $ville)
    {
        $this->ville->removeElement($ville);
    }

    /**
     * Get ville
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVille()
    {
        return $this->ville;
    }
}
