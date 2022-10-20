<?php
/**
 * @author <julienrajerison5@gmail.com>
 *
 * This file is part of techzara_platform | all right reserve to the_challengers https://github.com/7he-Challenger
 */
declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 *
 * @ApiResource(
 *     security="is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')",
 *     normalizationContext={"groups"="read"},
 *     denormalizationContext={"groups"="write"}
 *     )
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column()
     * @ORM\GeneratedValue()
     * @Groups({"read"})
     */
    private int $id;

    /**
     * @ORM\Column(type="text")
     *
     * @Groups({"write"})
     */
    private string $password;

    /**
     * @ORM\Column(type="string", unique=true)
     *
     * @Groups({"read", "write"})
     */
    private string $username;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"read", "write"})
     */
    private ?string $firstname;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"read", "write"})
     */
    private ?string $lastname;

    /**
     * @ORM\Column(type="simple_array")
     *
     * @Groups({"read", "write"})
     */
    private array $roles;

    /**
     * @ORM\OneToOne(targetEntity=UserInformation::class)
     *
     * @Groups({"read", "write"})
     */
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

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    /**
     * @param array|null $role
     *
     * @return User
     */
    public function setRoles(?array $role): User
    {
        $this->roles = is_array($role) ? $role : ['ROLE_USER'];

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

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username)
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
}
