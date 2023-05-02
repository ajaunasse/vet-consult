<?php

namespace App\Entity;

use App\Repository\InjuryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InjuryRepository::class)]
class Injury
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'injury', targetEntity: MajorInjuryClinicSign::class, cascade: ['persist', 'remove'])]
    private Collection $majorClinicSigns;

    public function __construct()
    {
        $this->majorClinicSigns = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, MajorInjuryClinicSign>
     */
    public function getMajorClinicSigns(): Collection
    {
        return $this->majorClinicSigns;
    }

    public function addMajorClinicSign(MajorInjuryClinicSign $majorClinicSign): self
    {
        if (!$this->majorClinicSigns->contains($majorClinicSign)) {
            $this->majorClinicSigns->add($majorClinicSign);
            $majorClinicSign->setInjury($this);
        }

        return $this;
    }

    public function removeMajorClinicSign(MajorInjuryClinicSign $majorClinicSign): self
    {
        if ($this->majorClinicSigns->removeElement($majorClinicSign)) {
            // set the owning side to null (unless already changed)
            if ($majorClinicSign->getInjury() === $this) {
                $majorClinicSign->setInjury(null);
            }
        }

        return $this;
    }

    public function matchWithSymptom(array $symptoms): bool
    {

        $numberOfMajorClinicSign = $this->majorClinicSigns->count();
        $matchedSymptoms = [];
        foreach ($symptoms as $examenId => $symptom) {
            $matchedSymptoms[] = array_filter(
                $this->majorClinicSigns->toArray(),
                function (MajorInjuryClinicSign $clinicSign) use ($examenId, $symptom) {
                    return $examenId === $clinicSign->getExamen()->getId()
                        && $symptom['symptom']['id'] === $clinicSign->getExpectedValue()->getId();
                });
        }
        return $numberOfMajorClinicSign === count(array_filter($matchedSymptoms));
    }
}
