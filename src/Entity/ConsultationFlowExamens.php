<?php

namespace App\Entity;

use App\Repository\ConsultationFlowExamensRepository;
use Doctrine\ORM\Mapping as ORM;

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

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ClinicExamen $clinicExamen = null;

    #[ORM\Column]
    private ?float $position = null;

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
}
