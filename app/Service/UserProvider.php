<?php
/*
Permet la connexion est d'instancier ma propre classe d'utilisateur
fonctionne avec du doctrine en interne
*/

namespace App\Service;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Doctrine\DBAL\Connection;
use \Echyzen\Entity\UserEntity;


class UserProvider implements UserProviderInterface
{
    private $conn;

    /**
    * Constructeur qui prend une instance Doctrine\DBAL pour pouvoir utiliser doctrine
    * lors de la reqiête à la base de données
    */
    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    /**
    * Permet de charger un utilisateur à partir de son username
    */
    public function loadUserByUsername($username)
    {
        $stmt = $this->conn->executeQuery('SELECT * FROM users WHERE username = ?', array(strtolower($username)));

        if (!$user = $stmt->fetch()) {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }
        // Penser à modifier ce constructeur de mon instance d'User en cas de modification de la table users en BDD
        // ou du constructeur de \Echyzen\Entity\UserEntity
          return new  \Echyzen\Entity\UserEntity($user['username'], $user['password'], null,
           array($user['roles']), $user['registrationday'], $user['birthday'], $user['website']);
         
    }

    public function refreshUser(UserInterface $user)
    {
        // Modifier instanceof \Echyzen\Entity\UserEntity si le retour de loadByUsername est différent
        // cad si modififcation de ma classe d'utilisateur \Echyzen\Entity\UserEntity
        if (!$user instanceof \Echyzen\Entity\UserEntity) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    /**
    * Non de ma propre classe d'User sinon par défaut si table users de Symfony utiliser Symfony\Component\Security\Core\User\User
    */
    public function supportsClass($class)
    {
        return $class === 'Echyzen\Entity\UserEntity';
    }
}