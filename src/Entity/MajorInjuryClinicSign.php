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
    private ?ClinicExamen $examen = null;

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

    /**
     * @return ClinicExamen|null
     */
    public function getExamen(): ?ClinicExamen
    {
        return $this->examen;
    }

    /**
     * @param ClinicExamen|null $examen
     * @return MajorInjuryClinicSign
     */
    public function setExamen(?ClinicExamen $examen): MajorInjuryClinicSign
    {
        $this->examen = $examen;
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
        if(null === $this->examen->getSubTitle()) {
            return $this->examen->getType();
        }

        return $this->examen->getType() . ' - '.$this->examen->getSubTitle() . ' = ' . $this->expectedValue->getName();
    }
}
