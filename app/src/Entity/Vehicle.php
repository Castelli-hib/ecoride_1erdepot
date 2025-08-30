<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $year = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?int $kilometer = null;

    #[ORM\Column]
    private ?bool $isActif = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'vehicle')]
    private Collection $userVehicle;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    private ?Brand $brandVehicle = null;

    public function __construct()
    {
        $this->userVehicle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getKilometer(): ?int
    {
        return $this->kilometer;
    }

    public function setKilometer(int $kilometer): static
    {
        $this->kilometer = $kilometer;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->isActif;
    }

    public function setIsActif(bool $isActif): static
    {
        $this->isActif = $isActif;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserVehicle(): Collection
    {
        return $this->userVehicle;
    }

    public function addUserVehicle(User $userVehicle): static
    {
        if (!$this->userVehicle->contains($userVehicle)) {
            $this->userVehicle->add($userVehicle);
            $userVehicle->setVehicle($this);
        }

        return $this;
    }

    public function removeUserVehicle(User $userVehicle): static
    {
        if ($this->userVehicle->removeElement($userVehicle)) {
            // set the owning side to null (unless already changed)
            if ($userVehicle->getVehicle() === $this) {
                $userVehicle->setVehicle(null);
            }
        }

        return $this;
    }

    public function getBrandVehicle(): ?Brand
    {
        return $this->brandVehicle;
    }

    public function setBrandVehicle(?Brand $brandVehicle): static
    {
        $this->brandVehicle = $brandVehicle;

        return $this;
    }
}
