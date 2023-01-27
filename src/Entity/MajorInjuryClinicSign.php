<?php

namespace App\Entity;

use App\Repository\MajorInjuryClinicSignRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MajorInjuryClinicSignRepository::class)]
class MajorInjuryClinicSign implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ClinicSignType $type = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ClinicSignValue $expectedValue = null;

    #[ORM\ManyToOne(inversedBy: 'majorClinicSigns')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Injury $injury = null;

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

    public function getExpectedValue(): ?ClinicSignValue
    {
        return $this->expectedValue;
    }

    public function setExpectedValue(?ClinicSignValue $expectedValue): self
    {
        $this->expectedValue = $expectedValue;

        return $this;
    }

    public function getInjury(): ?Injury
    {
        return $this->injury;
    }

    public function setInjury(?Injury $injury): self
    {
        $this->injury = $injury;

        return $this;
    }

    public function __toString(): string
    {
        return $this->type->getName() . ' = ' . $this->expectedValue->getName();
    }
}
