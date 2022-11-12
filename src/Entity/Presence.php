<?php
/**
 * @author <julienrajerison5@gmail.com>
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;

/**
 * Class Presence.
 *
 * @ORM\Entity()
 * @ApiResource(
 *     security="is_grated('ROLE_ADMIN') or object.user == user",
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get", "put"}
 * )
 * @ApiFilter(SearchFilter::class, properties={"isPresent": "exact", "user": "exact", "user.username": "partial", "activity": "exact"})
 * @ApiFilter(DateFilter::class, properties={"date"})
 */
class Presence
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column()
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private bool $isPresent;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     * @ApiProperty(attributes={
     *     "normalization_context"={
     *         "datetime_format"="Y-m-d",
     *     },
     * })
     */
    private DateTime $date;

    /**
     * @ORM\ManyToOne(targetEntity=Activity::class, inversedBy="presences")
     */
    private ?Activity $activity;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="presences")
     */
    private ?User $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $email;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $isGuest;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Presence
     */
    public function setId(int $id): Presence
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPresent(): bool
    {
        return $this->isPresent;
    }

    /**
     * @param bool $isPresent
     *
     * @return Presence
     */
    public function setIsPresent(bool $isPresent): Presence
    {
        $this->isPresent = $isPresent;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     *
     * @return Presence
     */
    public function setDate(DateTime $date): Presence
    {
        $this->date = $date;

        return $this;
    }

    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    public function setActivity(?Activity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function isGuest(): ?bool
    {
        return $this->isGuest;
    }

    public function setGuest(?bool $guest): self
    {
        $this->isGuest = $guest;

        return $this;
    }
}
