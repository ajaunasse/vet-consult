<?php

namespace App\Entity;

use App\Repository\ConsultationFlowExamensRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ConsultationFlowExamensRepository::class)]
class ConsultationFlowExamens
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'examens')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ConsultationFlow $consultationFlow = null;

    #[Groups(['get'])]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ClinicExamen $clinicExamen = null;
    
    #[Groups(['get'])]
    #[ORM\Column]
    private ?float $position = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'subExamens')]
    private ?self $parentExamen = null;

    #[Groups(['get'])]
    #[ORM\OneToMany(mappedBy: 'parentExamen', targetEntity: self::class)]
    private Collection $subExamens;

    public function __construct()
    {
        $this->subExamens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConsultationFlow(): ?ConsultationFlow
    {
        return $this->consultationFlow;
    }

    public function setConsultationFlow(?ConsultationFlow $consultationFlow): self
    {
        $this->consultationFlow = $consultationFlow;

        return $this;
    }

    public function getClinicExamen(): ?ClinicExamen
    {
        return $this->clinicExamen;
    }

    public function setClinicExamen(?ClinicExamen $clinicExamen): self
    {
        $this->clinicExamen = $clinicExamen;

        return $this;
    }

    public function getPosition(): ?float
    {
        return $this->position;
    }

    public function setPosition(float $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getParentExamen(): ?self
    {
        return $this->parentExamen;
    }

    public function setParentExamen(?self $parentExamen): self
    {
        $this->parentExamen = $parentExamen;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getSubExamens(): Collection
    {
        return $this->subExamens;
    }

    public function addSubExamen(self $subExamen): self
    {
        if (!$this->subExamens->contains($subExamen)) {
            $this->subExamens->add($subExamen);
            $subExamen->setParentExamen($this);
        }

        return $this;
    }

    public function removeSubExamen(self $subExamen): self
    {
        if ($this->subExamens->removeElement($subExamen)) {
            // set the owning side to null (unless already changed)
            if ($subExamen->getParentExamen() === $this) {
                $subExamen->setParentExamen(null);
            }
        }

        return $this;
    }
}
