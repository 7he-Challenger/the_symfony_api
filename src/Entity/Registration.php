<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RegistrationRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RegistrationRepository::class)
 * @ApiResource(
 *     itemOperations={"delete" = {"security"="is_granted('ROLE_ADMIN')"}, "put", "get"},
 *     collectionOperations={"post", "get"},
 *     denormalizationContext={"groups"="registration:write"},
 *     normalizationContext={"groups"="registration:read"}
 * )
 * @ApiFilter(SearchFilter::class, properties={"event": "exact", "email": "partial", "isConfirmed": "exact"})
 */
class Registration
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("registration:read")
     */
    private ?int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Activity::class, inversedBy="registrations")
     * @Groups({"registration:read", "registration:write"})
     */
    private ?Activity $event;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"registration:read", "registration:write"})
     */
    private ?string $email;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"registration:read"})
     */
    private bool $isConfirmed;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("registration:read")
     *
     * @ApiProperty(attributes={
     *     "normalization_context"={
     *         "datetime_format"="Y-m-d",
     *     },
     * })
     */
    private ?DateTimeInterface $registrationDate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"registration:read", "registration:write"})
     */
    private ?int $seatNumber;

    public function __construct()
    {
        $this->isConfirmed = true;
        $this->registrationDate = new DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): ?Activity
    {
        return $this->event;
    }

    public function setEvent(?Activity $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function isIsConfirmed(): ?bool
    {
        return $this->isConfirmed;
    }

    public function setIsConfirmed(bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed;

        return $this;
    }

    public function getRegistrationDate(): ?DateTimeInterface
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(DateTimeInterface $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    public function getSeatNumber(): ?int
    {
        return $this->seatNumber;
    }

    public function setSeatNumber(?int $seatNumber): self
    {
        $this->seatNumber = $seatNumber;

        return $this;
    }
}
