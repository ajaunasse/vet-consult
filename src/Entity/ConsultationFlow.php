<?php

namespace App\Entity;

use App\Repository\ConsultationFlowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ConsultationFlowRepository::class)]
class ConsultationFlow
{
    #[Groups(['get'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['get'])]
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?ConsultationReason $reason = null;

    #[Groups(['get'])]
    #[ORM\OneToMany(mappedBy: 'consultationFlow', targetEntity: ConsultationFlowExamens::class, cascade: ['persist', 'remove'])]
    private Collection $examens;

    public function __construct()
    {
        $this->examens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReason(): ?ConsultationReason
    {
        return $this->reason;
    }

    public function setReason(ConsultationReason $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * @return Collection<int, ConsultationFlowExamens>
     */
    public function getExamens(): Collection
    {
        return $this->examens;
    }

    public function addExamen(ConsultationFlowExamens $examen): self
    {
        if (!$this->examens->contains($examen)) {
            $this->examens->add($examen);
            $examen->setConsultationFlow($this);
        }

        return $this;
    }

    public function removeExamen(ConsultationFlowExamens $examen): self
    {
        if ($this->examens->removeElement($examen)) {
            // set the owning side to null (unless already changed)
            if ($examen->getConsultationFlow() === $this) {
                $examen->setConsultationFlow(null);
            }
        }

        return $this;
    }
}
