<?php

namespace App\Entity;

use App\Repository\ExamenStepRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ExamenStepRepository::class)]
class ExamenStep
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'examenSteps')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ConsultationFlow $consultationFlow = null;

    #[ORM\ManyToMany(targetEntity: ClinicExamen::class)]
    private Collection $examens;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: true)]
    private ?ClinicSignValue $triggerValue = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: true)]
    private ?ClinicExamen $triggerExamen = null;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'nextExamens')]
    private ?self $previousExamen = null;

    #[ORM\OneToMany(mappedBy: 'previousExamen', targetEntity: self::class)]
    private Collection $nextExamens;


    public function __construct()
    {
        $this->examens = new ArrayCollection();
        $this->nextExamens = new ArrayCollection();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): ExamenStep
    {
        $this->name = $name;
        return $this;
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


    public function getTriggerValue(): ?ClinicSignValue
    {
        return $this->triggerValue;
    }

    public function setTriggerValue(?ClinicSignValue $triggerValue): self
    {
        $this->triggerValue = $triggerValue;

        return $this;
    }

    public function getTriggerExamen(): ?ClinicExamen
    {
        return $this->triggerExamen;
    }

    public function setTriggerExamen(?ClinicExamen $triggerExamen): void
    {
        $this->triggerExamen = $triggerExamen;
    }


    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getExamens(): Collection
    {
        return $this->examens;
    }

    public function setExamens(Collection $examens): self
    {
        $this->examens = $examens;
        return $this;
    }

    public function addExamen(ClinicExamen $clinicExamen): self
    {
        if (!$this->examens->contains($clinicExamen)) {
            $this->examens->add($clinicExamen);
        }

        return $this;
    }

    public function removeExamen(ClinicExamen $clinicExamen): self
    {
        $this->examens->removeElement($clinicExamen);

        return $this;
    }

    public function getPreviousExamen(): ?self
    {
        return $this->previousExamen;
    }

    public function setPreviousExamen(?self $previousExamen): self
    {
        $this->previousExamen = $previousExamen;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getNextExamens(): Collection
    {
        return $this->nextExamens;
    }

    public function addNextExamen(self $nextExamen): self
    {
        if (!$this->nextExamens->contains($nextExamen)) {
            $this->nextExamens->add($nextExamen);
            $nextExamen->setPreviousExamen($this);
        }

        return $this;
    }

    public function removeNextExamen(self $nextExamen): self
    {
        if ($this->nextExamens->removeElement($nextExamen)) {
            // set the owning side to null (unless already changed)
            if ($nextExamen->getPreviousExamen() === $this) {
                $nextExamen->setPreviousExamen(null);
            }
        }

        return $this;
    }


}
