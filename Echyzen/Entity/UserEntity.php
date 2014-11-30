<?php
 namespace Echyzen\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Adds PDO methods to the application.
 *
 */
class UserEntity implements UserInterface
{
	private $username;
    private $password;
    private $salt;
    private $roles;
    private $dateInscription;
    private $birthday;
    private $website;

    public function __construct($username, $password, $salt, array $roles, $dateInscription, $birthday, $website)
    {
        $this->username = $username;
        $this->password = $password;
        $this->salt = $salt;
        $this->roles = $roles;
		$this->dateInscription = $dateInscription;
		$this->birthday = $birthday;
		$this->website = $website;
    }

    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function getBirthDay()
    {
        return $this->birthday;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
    }

    public function equals(UserInterface $user)
    {
        if (!$user instanceof UserEntity) {
            return false;
        }

        if ($this->password !== $user->getPassword()) {
            return false;
        }

        if ($this->getSalt() !== $user->getSalt()) {
            return false;
        }

        if ($this->username !== $user->getUsername()) {
            return false;
        }


        if ($this->dateInscription !== $user->getDateInscription()) {
            return false;
        }


        if ($this->birthDay !== $user->getBirthDay()) {
            return false;
        }


        if ($this->website !== $user->getWebsite()) {
            return false;
        }
        return true;
    }
}