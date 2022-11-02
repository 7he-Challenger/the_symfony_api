<?php
/**
 * @author <julienrajerison5@gmail.com>
 */
declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 *
 * Class UserInformation.
 *
 * This file is part of techzara_platform | all right reserve to the_challengers https://github.com/7he-Challenger
 */
class UserInformation
{
    /**
     * @ORM\Id()
     * @ORM\Column()
     * @ORM\GeneratedValue()
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"user:read", "user:write"})
     */
    private ?string $address;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"user:read", "user:write"})
     */
    private ?string $phone;

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     *
     * @return UserInformation
     */
    public function setAddress(?string $address): UserInformation
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     *
     * @return UserInformation
     */
    public function setPhone(?string $phone): UserInformation
    {
        $this->phone = $phone;

        return $this;
    }
}
