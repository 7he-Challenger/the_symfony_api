<?php
/**
 * @author <julienrajerison5@gmail.com>
 *
 *This file is part of techzara_platform | all right reserve to the_challengers https://github.com/7he-Challenger
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Activity.
 *
 * @ORM\Entity()
 * @ApiResource(security="is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')")
 */
class Activity
{
    public const EVENT_TYPE = [
        1 => 'event',
        2 => 'meetup',
    ];

    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\Column()
     * @ORM\GeneratedValue()
     */
    private ?int $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $title;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTime $date;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $locale;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $intervenant;

    /**
     * @var array|null
     *
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private ?array $sponsors;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $type;

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
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     *
     * @return Activity
     */
    public function setTitle(?string $title): Activity
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     *
     * @return Activity
     */
    public function setDescription(?string $description): Activity
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime|null $date
     *
     * @return Activity
     */
    public function setDate(?DateTime $date): Activity
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * @param string|null $locale
     *
     * @return Activity
     */
    public function setLocale(?string $locale): Activity
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIntervenant(): ?string
    {
        return $this->intervenant;
    }

    /**
     * @param string|null $intervenant
     *
     * @return Activity
     */
    public function setIntervenant(?string $intervenant): Activity
    {
        $this->intervenant = $intervenant;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getSponsors(): ?array
    {
        return $this->sponsors;
    }

    /**
     * @param array|null $sponsors
     *
     * @return Activity
     */
    public function setSponsors(?array $sponsors): Activity
    {
        $this->sponsors = $sponsors;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int|null $type
     *
     * @return Activity
     */
    public function setType(?int $type): Activity
    {
        $this->type = $type;

        return $this;
    }
}
