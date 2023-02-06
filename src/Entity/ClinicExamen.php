<?php

namespace App\Entity;

use App\Repository\ClinicExamenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ClinicExamenRepository::class)]
class ClinicExamen
{
    #[Groups(['get'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['get'])]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ClinicSignType $type = null;

    #[Groups(['get'])]
    #[ORM\ManyToMany(targetEntity: ClinicSignValue::class)]
    private Collection $availableValues;

    public function __construct()
    {
        $this->availableValues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?ClinicSignType
    {
        return $this->type;
    }

    public function setType(?ClinicSignType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, ClinicSignValue>
     */
    public function getAvailableValues(): Collection
    {
        return $this->availableValues;
    }

    public function addAvailableValue(ClinicSignValue $availableValue): self
    {
        if (!$this->availableValues->contains($availableValue)) {
            $this->availableValues->add($availableValue);
        }

        return $this;
    }

    public function removeAvailableValue(ClinicSignValue $availableValue): self
    {
        $this->availableValues->removeElement($availableValue);

        return $this;
    }

    #[Groups(['get'])]
    public function getFullValue(): string
    {
        return $this->type->getName() . ' (' . implode(', ', $this->availableValues->toArray()) . ')';
    }
}
