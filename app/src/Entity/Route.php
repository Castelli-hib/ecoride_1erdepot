<?php

namespace App\Entity;

use App\Repository\RouteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RouteRepository::class)]
class Route
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $departureTown = null;

    #[ORM\Column(length: 255)]
    private ?string $arrivalTown = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $departureDay = null;

    #[ORM\Column]
    private ?\DateTime $departureTime = null;

    #[ORM\Column]
    private ?int $travelTime = null;

    #[ORM\Column]
    private ?bool $correspondance = null;

    #[ORM\Column(length: 255)]
    private ?string $correspondanceDetail = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'routes')]
    private Collection $userRoute;

    public function __construct()
    {
        $this->userRoute = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepartureTown(): ?string
    {
        return $this->departureTown;
    }

    public function setDepartureTown(string $departureTown): static
    {
        $this->departureTown = $departureTown;

        return $this;
    }

    public function getArrivalTown(): ?string
    {
        return $this->arrivalTown;
    }

    public function setArrivalTown(string $arrivalTown): static
    {
        $this->arrivalTown = $arrivalTown;

        return $this;
    }

    public function getDepartureDay(): ?\DateTime
    {
        return $this->departureDay;
    }

    public function setDepartureDay(\DateTime $departureDay): static
    {
        $this->departureDay = $departureDay;

        return $this;
    }

    public function getDepartureTime(): ?\DateTime
    {
        return $this->departureTime;
    }

    public function setDepartureTime(\DateTime $departureTime): static
    {
        $this->departureTime = $departureTime;

        return $this;
    }

    public function getTravelTime(): ?int
    {
        return $this->travelTime;
    }

    public function setTravelTime(int $travelTime): static
    {
        $this->travelTime = $travelTime;

        return $this;
    }

    public function isCorrespondance(): ?bool
    {
        return $this->correspondance;
    }

    public function setCorrespondance(bool $correspondance): static
    {
        $this->correspondance = $correspondance;

        return $this;
    }

    public function getCorrespondanceDetail(): ?string
    {
        return $this->correspondanceDetail;
    }

    public function setCorrespondanceDetail(string $correspondanceDetail): static
    {
        $this->correspondanceDetail = $correspondanceDetail;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserRoute(): Collection
    {
        return $this->userRoute;
    }

    public function addUserRoute(User $userRoute): static
    {
        if (!$this->userRoute->contains($userRoute)) {
            $this->userRoute->add($userRoute);
        }

        return $this;
    }

    public function removeUserRoute(User $userRoute): static
    {
        $this->userRoute->removeElement($userRoute);

        return $this;
    }
}
