<?php
/**
 * @author <julienrajerison5@gmail.com>
 *
 * This file is part of techzara_platform | all right reserve to the_challengers https://github.com/7he-Challenger
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Certificate.
 *
 * @ORM\Entity()
 * @ApiResource(
 *     normalizationContext={"groups"="read"},
 *     denormalizationContext={"groups"="write"}
 * )
 */
class Certificate
{
    /**
     * @ORM\Id()
     * @ORM\Column()
     * @ORM\GeneratedValue()
     */
    private ?int $id;

    /**
     * @ORM\Column(type="text")
     *
     * @Groups({"read", "write"})
     */
    private ?string $username;

    /**
     * @ORM\Column(type="string")
     *
     * @Groups({"read", "write"})
     */
    private ?string $email;

    /**
     * @ORM\Column(type="text")
     *
     * @Groups({"read"})
     */
    private ?string $certId;

    /**
     * @ORM\Column(type="text")
     *
     * @Groups({"read", "write"})
     */
    private ?string $title;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->certId = bin2hex(random_bytes(20));
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     *
     * @return Certificate
     */
    public function setUsername(?string $username): Certificate
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     *
     * @return Certificate
     */
    public function setEmail(?string $email): Certificate
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCertId(): ?string
    {
        return $this->certId;
    }

    /**
     * @param string|null $certId
     *
     * @return Certificate
     */
    public function setCertId(?string $certId): Certificate
    {
        $this->certId = $certId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     *
     * @return Certificate
     */
    public function setTitle(?string $title): Certificate
    {
        $this->title = $title;

        return $this;
    }
}
