<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\Column]
    private ?int $notation = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'avis')]
    private Collection $userAvis;

    public function __construct()
    {
        $this->userAvis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getNotation(): ?int
    {
        return $this->notation;
    }

    public function setNotation(int $notation): static
    {
        $this->notation = $notation;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserAvis(): Collection
    {
        return $this->userAvis;
    }

    public function addUserAvi(User $userAvi): static
    {
        if (!$this->userAvis->contains($userAvi)) {
            $this->userAvis->add($userAvi);
            $userAvi->setAvis($this);
        }

        return $this;
    }

    public function removeUserAvi(User $userAvi): static
    {
        if ($this->userAvis->removeElement($userAvi)) {
            // set the owning side to null (unless already changed)
            if ($userAvi->getAvis() === $this) {
                $userAvi->setAvis(null);
            }
        }

        return $this;
    }
}
