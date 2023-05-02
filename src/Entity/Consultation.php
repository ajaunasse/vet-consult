<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsultationRepository::class)]
class Consultation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ConsultationReason $reasons = null;

    #[ORM\ManyToMany(targetEntity: ExamenStep::class)]
    private Collection $previousExamensSteps;

    #[ORM\ManyToOne]
    private ?ExamenStep $currentStep = null;

    #[ORM\Column(nullable: true)]
    private array $symptoms = [];

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ConsultationFlow $consultationFlow = null;

    public function __construct()
    {
        $this->previousExamensSteps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReasons(): ?ConsultationReason
    {
        return $this->reasons;
    }

    public function setReasons(?ConsultationReason $reasons): self
    {
        $this->reasons = $reasons;

        return $this;
    }

    /**
     * @return Collection<int, ExamenStep>
     */
    public function getPreviousExamensSteps(): Collection
    {
        return $this->previousExamensSteps;
    }

    public function addPreviousExamensStep(ExamenStep $previousExamensStep): self
    {
        if (!$this->previousExamensSteps->contains($previousExamensStep)) {
            $this->previousExamensSteps->add($previousExamensStep);
        }

        return $this;
    }

    public function removePreviousExamensStep(ExamenStep $previousExamensStep): self
    {
        $this->previousExamensSteps->removeElement($previousExamensStep);

        return $this;
    }

    public function getCurrentStep(): ?ExamenStep
    {
        return $this->currentStep;
    }

    public function setCurrentStep(?ExamenStep $currentStep): self
    {
        $this->currentStep = $currentStep;

        return $this;
    }

    public function getSymptoms(): array
    {
        return $this->symptoms;
    }

    public function setSymptoms(?array $symptoms): self
    {
        $this->symptoms = $symptoms;

        return $this;
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

    public function addSymptom(ClinicExamen $examen, ClinicSignValue $value): void
    {
        $symptoms = $this->getSymptoms();
        $symptoms[$examen->getId()] = [
            'examen' => trim($examen->getFullname()),
            'symptom' => [ 'id'=> $value->getId(), 'name'=> $value->getName()]
        ];

        $this->setSymptoms($symptoms);
    }
}
