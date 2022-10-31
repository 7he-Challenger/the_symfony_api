<?php
/**
 * @author <julienrajerison5@gmail.com>
 *
 *This file is part of techzara_platform | all right reserve to the_challengers https://github.com/7he-Challenger
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * Class Activity.
 *
 * @ORM\Entity()
 * @ApiResource(security="is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')")
 * @ApiFilter(DateFilter::class, properties={"startDate", "endDate"})
 * @ApiFilter(SearchFilter::class, properties={"title":"partial", "description":"partial", "isEnable": "exact", "isPublic": "exact"})
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
     * @ApiProperty(attributes={
     *     "normalization_context"={
     *         "datetime_format"="Y-m-d",
     *     },
     * })
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTime $startDate;

    /**
     * @var DateTime|null
     * @ApiProperty(attributes={
     *     "normalization_context"={
     *         "datetime_format"="Y-m-d",
     *     },
     * })
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTime $endDate;

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
     * @var bool|null
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $isPublic;

    /**
     * @var bool|null
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $isEnable;

    /**
     * @var Collection|null
     *
     * @ORM\OneToMany(targetEntity=MediaObject::class, mappedBy="poster", cascade={"all"})
     */
    private ?Collection $posters;

    /**
     * Activity constructor
     */
    public function __construct()
    {
        $this->isEnable = true;
        $this->isPublic = false;
        $this->posters = new ArrayCollection();
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

    /**
     * @return DateTime|null
     */
    public function getStartDate(): ?DateTime
    {
        return $this->startDate;
    }

    /**
     * @param DateTime|null $startDate
     *
     * @return Activity
     */
    public function setStartDate(?DateTime $startDate): Activity
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getEndDate(): ?DateTime
    {
        return $this->endDate;
    }

    /**
     * @param DateTime|null $endDate
     *
     * @return Activity
     */
    public function setEndDate(?DateTime $endDate): Activity
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsEnable(): ?bool
    {
        return $this->isEnable;
    }

    /**
     * @param bool|null $isEnable
     *
     * @return Activity
     */
    public function setIsEnable(?bool $isEnable): Activity
    {
        $this->isEnable = $isEnable;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsPublic(): ?bool
    {
        return $this->isPublic;
    }

    /**
     * @param bool|null $isPublic
     *
     * @return Activity
     */
    public function setIsPublic(?bool $isPublic): Activity
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getPosters()
    {
        return $this->posters;
    }

    /**
     * @param MediaObject|null $posters
     *
     * @return Activity
     */
    public function addPosters(?MediaObject $posters): Activity
    {
        $this->posters->add($posters);

        return $this;
    }

    /**
     * @param MediaObject|null $posters
     *
     * @return Activity
     */
    public function removePosters(?MediaObject $posters): Activity
    {
        $this->posters->removeElement($posters);

        return $this;
    }
}
