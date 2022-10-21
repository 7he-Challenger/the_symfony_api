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

/**
 * Class Presence.
 *
 * @ORM\Entity()
 * @ApiResource()
 * @ApiFilter(SearchFilter::class, properties={"isPresent": "exact", "user": "exact"})
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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="presences")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private User $user;

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

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return Presence
     */
    public function setUser(User $user): Presence
    {
        $this->user = $user;

        return $this;
    }
}
