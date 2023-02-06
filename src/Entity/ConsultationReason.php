<?php

namespace App\Entity;

use App\Repository\ConsultationReasonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ConsultationReasonRepository::class)]
#[UniqueEntity('value')]
class ConsultationReason
{
    #[Groups(['get'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['get'])]
    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $value = null;

    #[ORM\OneToMany(mappedBy: 'consultationReason', targetEntity: Injury::class)]
    private Collection $injuries;

    public function __construct()
    {
        $this->injuries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @return Collection<int, Injury>
     */
    public function getInjuries(): Collection
    {
        return $this->injuries;
    }

    public function addInjury(Injury $injury): self
    {
        if (!$this->injuries->contains($injury)) {
            $this->injuries->add($injury);
            $injury->setConsultationReason($this);
        }

        return $this;
    }

    public function removeInjury(Injury $injury): self
    {
        if ($this->injuries->removeElement($injury)) {
            // set the owning side to null (unless already changed)
            if ($injury->getConsultationReason() === $this) {
                $injury->setConsultationReason(null);
            }
        }

        return $this;
    }
}
