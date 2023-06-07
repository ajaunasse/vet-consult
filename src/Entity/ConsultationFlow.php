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

    #[ORM\OneToMany(mappedBy: 'consultationFlow', targetEntity: ExamenStep::class, fetch: 'EAGER', orphanRemoval: true)]
    private Collection $examenSteps;

    public function __construct()
    {
        $this->examenSteps = new ArrayCollection();
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
     * @return Collection<int, ExamenStep>
     */
    public function getExamenSteps(): Collection
    {
        return $this->examenSteps;
    }

    public function addExamenStep(ExamenStep $examenStep): self
    {
        if (!$this->examenSteps->contains($examenStep)) {
            $this->examenSteps->add($examenStep);
            $examenStep->setConsultationFlow($this);
        }

        return $this;
    }

    public function removeExamenStep(ExamenStep $examenStep): self
    {
        if ($this->examenSteps->removeElement($examenStep)) {
            // set the owning side to null (unless already changed)
            if ($examenStep->getConsultationFlow() === $this) {
                $examenStep->setConsultationFlow(null);
            }
        }

        return $this;
    }

    public function getFirstStep(): ?ExamenStep
    {
        return $this->examenSteps->first();
    }

    public function findNextStep(int $nextStepPosition, array $triggerValuesId, int $currentExamenStepId): ?ExamenStep
    {

        $nextSteps = new ArrayCollection();
        $probableNextSteps = $this->examenSteps->filter(function (ExamenStep $step) use ($nextStepPosition, $currentExamenStepId) {
            return  $step->getPosition() === $nextStepPosition
                && $step->getPreviousExamen()->getId() === $currentExamenStepId
            ;
        });

        if($probableNextSteps->count() === 1 && null === $probableNextSteps->first()->getTriggerValue()) {
            return $probableNextSteps->first();
        }

        foreach ($triggerValuesId as $examenId => $valueId) {
            $nextSteps = $probableNextSteps->filter(function (ExamenStep $step) use ($examenId, $valueId) {
                if($step->getTriggerExamen() === null || $step->getTriggerValue() === null) {
                    return false;
                }
                return $step->getTriggerExamen()->getId() === (int) $examenId
                    && $step->getTriggerValue()->getId() === (int) $valueId
                ;
            });

            if($nextSteps->count() === 1) {
                break;
            }
        }

        if($nextSteps->count()=== 0) {
            return null;
        }

        return $nextSteps->first();
    }
}
