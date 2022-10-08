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
 * @ApiResource(
 *     security="is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')",
 *     normalizationContext={"groups"="read"},
 *     denormalizationContext={"groups"="write"}
 *     )
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
     * @Groups({"read", "write"})
     */
    private ?string $address;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"read", "write"})
     */
    private ?string $phone;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({"read", "write"})
     */
    private ?string $photos;

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

    /**
     * @return string|null
     */
    public function getPhotos(): ?string
    {
        return $this->photos;
    }

    /**
     * @param string|null $photos
     *
     * @return UserInformation
     */
    public function setPhotos(?string $photos): UserInformation
    {
        $this->photos = $photos;

        return $this;
    }
}
