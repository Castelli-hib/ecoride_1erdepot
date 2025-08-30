<?php

namespace App\Entity;

use App\Repository\PreferencesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PreferencesRepository::class)]
class Preferences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $animal = null;

    #[ORM\Column]
    private ?bool $smoker = null;

    #[ORM\Column]
    private ?bool $music = null;

    #[ORM\Column]
    private ?bool $disbled_equipment = null;

    #[ORM\Column]
    private ?bool $trailer = null;

    #[ORM\Column]
    private ?bool $usb_charger = null;

    #[ORM\Column]
    private ?bool $tablet = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'preferences')]
    private Collection $user_id;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isAnimal(): ?bool
    {
        return $this->animal;
    }

    public function setAnimal(bool $animal): static
    {
        $this->animal = $animal;

        return $this;
    }

    public function isSmoker(): ?bool
    {
        return $this->smoker;
    }

    public function setSmoker(bool $smoker): static
    {
        $this->smoker = $smoker;

        return $this;
    }

    public function isMusic(): ?bool
    {
        return $this->music;
    }

    public function setMusic(bool $music): static
    {
        $this->music = $music;

        return $this;
    }

    public function isDisbledEquipment(): ?bool
    {
        return $this->disbled_equipment;
    }

    public function setDisbledEquipment(bool $disbled_equipment): static
    {
        $this->disbled_equipment = $disbled_equipment;

        return $this;
    }

    public function isTrailer(): ?bool
    {
        return $this->trailer;
    }

    public function setTrailer(bool $trailer): static
    {
        $this->trailer = $trailer;

        return $this;
    }

    public function isUsbCharger(): ?bool
    {
        return $this->usb_charger;
    }

    public function setUsbCharger(bool $usb_charger): static
    {
        $this->usb_charger = $usb_charger;

        return $this;
    }

    public function isTablet(): ?bool
    {
        return $this->tablet;
    }

    public function setTablet(bool $tablet): static
    {
        $this->tablet = $tablet;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(User $userId): static
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id->add($userId);
        }

        return $this;
    }

    public function removeUserId(User $userId): static
    {
        $this->user_id->removeElement($userId);

        return $this;
    }
}
