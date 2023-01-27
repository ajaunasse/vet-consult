<?php

namespace App\Entity;

use App\Repository\ClinicSignTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ClinicSignTypeRepository::class)]
#[UniqueEntity('name')]
class ClinicSignType implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['get'])]
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: self::class)]
    private ?self $mainType = null;

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

    public function getMainType(): ?self
    {
        return $this->mainType;
    }

    public function setMainType(?self $mainType): self
    {
        $this->mainType = $mainType;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
