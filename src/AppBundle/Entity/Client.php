<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientRepository")
 */
class Client implements \Symfony\Component\Security\Core\User\UserInterface, \Serializable
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
     * @ORM\OneToMany(targetEntity="Commande", mappedBy="client")
     */
    private $commandes;

    /**
     * @ORM\Column(name="login", type="string", length=32, unique=true)
     */
    private $login;

    /**
     * @ORM\Column(name="mdp", type="string", length=8)
     */
    private $mdp;

    /**
     * @ORM\Column(name="role", type="string", length=20)
     */
    private $role;

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
     * Constructor
     */
    public function __construct()
    {
        $this->commandes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return Client
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set mdp
     *
     * @param string $mdp
     *
     * @return Client
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Add commande
     *
     * @param \AppBundle\Entity\Commande $commande
     *
     * @return Client
     */
    public function addCommande(\AppBundle\Entity\Commande $commande)
    {
        $this->commandes[] = $commande;

        return $this;
    }

    /**
     * Remove commande
     *
     * @param \AppBundle\Entity\Commande $commande
     */
    public function removeCommande(\AppBundle\Entity\Commande $commande)
    {
        $this->commandes->removeElement($commande);
    }

    /**
     * Get commandes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommandes()
    {
        return $this->commandes;
    }

    public function __toString()
    {
        return $this->login;
    }

    public function eraseCredentials()
    {
        
    }

    public function getPassword()
    {
        return $this->mdp;
    }

    public function getRoles()
    {
        $arrayRoles = array();
        if ($this->role != null)
        {
            $arrayRoles[] = $this->role;
        }
        return $arrayRoles;
//        return array("ROLE_SIMPLE");
    }

    public function getSalt()
    {
        
    }

    public function getUsername()
    {
        return $this->login;
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->login,
            $this->mdp,
            $this->role,
                // see section on salt below
                // $this->salt,
        ));
    }

    public function unserialize($serialized)
    {
        list (
                $this->id,
                $this->login,
                $this->mdp,
                $this->role,
                // see section on salt below
                // $this->salt
                ) = unserialize($serialized);
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Client
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

}
