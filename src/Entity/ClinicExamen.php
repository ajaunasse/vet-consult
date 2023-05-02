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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subTitle = null;

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

    public function getSubTitle(): ?string
    {
        return $this->subTitle;
    }

    public function setSubTitle(?string $subTitle): void
    {
        $this->subTitle = $subTitle;
    }

    #[Groups(['get'])]
    public function getFullValue(): string
    {
        return $this->type->getName() . ' (' . implode(', ', $this->availableValues->toArray()) . ')';
    }

    public function getFullname(): string
    {
        return $this->type->getName(). ' '. $this->getSubTitle();
    }

    public function findValue(int $valueId): ?ClinicSignValue
    {
        $values = new ArrayCollection(
                array_filter(
                $this->availableValues->toArray(),
                function (ClinicSignValue $clinicSignValue) use ($valueId) {
                    return $clinicSignValue->getId() === $valueId;
                })
        );

        if($values->count() === 0) {
            return null;
        }

        if($values->count() > 1) {
            throw new \Exception(sprintf('Multiple clinic sign value found for % ', $valueId));
        }

        return $values->first();
    }

    public function __toString(): string {
        return $this->getFullname();
    }
}
