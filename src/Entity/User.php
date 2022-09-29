<?php
/**
 * @author <julienrajerison5@gmail.com>
 */
declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\UserListController;
use App\Controller\UserUnityController;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity()
 *
 * @ApiResource(security="is_granted('ROLE_USER') OR is_granted('ROLE_ADMIN')")
 */

#[ApiResource(
    itemOperations:[
        'GetOneMember' => [
            'method' => 'GET',
            'path' => '/user/{id}/GetOneMember',
            'controller' => UserUnityController::class
        ]
    ],
    collectionOperations:[
        'ListAllMember' => [
            'method' => 'GET',
            'path' => '/user/ListAllMember',
            'controller' => UserListController::class
        ]
    ]
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column()
     * @ORM\GeneratedValue()
     */
    private ?int $id;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $password;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    
    private ?string $username;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $firstname;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $lastname;

    /**
     * @ORM\Column(type="simple_array")
     */
    private ?array $roles;

    #[ORM\OneToOne(targetEntity:UserInformation::class, cascade:'persist')]
    private ?UserInformation $userInfo;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): User
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param string|null $role
     *
     * @return User
     */
    public function setRoles(?string $role): User
    {
        $this->roles[] = $role ? : 'ROLE_USER';

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     *
     * @return User
     */
    public function setFirstname(?string $firstname): User
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string|null $lastname
     *
     * @return User
     */
    public function setLastname(?string $lastname): User
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials(): string
    {
        return '';
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return UserInformation|null
     */
    public function getUserInfo(): ?UserInformation
    {
        return $this->userInfo;
    }

    /**
     * @param UserInformation|null $userInfo
     *
     * @return User
     */
    public function setUserInfo(?UserInformation $userInfo): User
    {
        $this->userInfo = $userInfo;

        return $this;
    }

    public function __call($name, $arguments)
    {
        return $this->username;
    }

    public function getUserIdentifier()
    {
        
    }
}
