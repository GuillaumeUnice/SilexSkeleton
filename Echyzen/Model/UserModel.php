<?php
 namespace Echyzen\Model;
use Echyzen;
use App\AppEchyzen;
use Echyzen\Entity\UserEntity;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
/**
 * Adds PDO methods to the application.
 *
 */
class UserModel extends \Echyzen\BaseModel
{

    /**
    *   Return 1 if unsername already exist else 0
    */
    private function isUsername($username) {
        
        $req = $this->db->prepare('SELECT COUNT(*) FROM users WHERE username = :username');
        $req->execute(array(
            'username' => $username
            ));
        return ($req->fetchColumn(0));
        
    }

    public function addUser(UserEntity $u) {
        $req = $this->db->prepare('INSERT INTO users(username, password, roles) VALUES(:username, :password, :roles)');
            $req->execute(array(
                'username' => $u->getUsername(),
                'password' => $u->getPassword(),
                'roles' => $u->getRoles()
            ));
    }
}