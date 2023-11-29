<?php

namespace App\Entity;

use App\Repository\BijlesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BijlesRepository::class)]
class Bijles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $opmerkingen = null;

    #[ORM\ManyToOne(inversedBy: 'bijlessen')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $student = null;

    #[ORM\ManyToOne(inversedBy: 'teacherbijles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $docent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getOpmerkingen(): ?string
    {
        return $this->opmerkingen;
    }

    public function setOpmerkingen(string $opmerkingen): static
    {
        $this->opmerkingen = $opmerkingen;

        return $this;
    }

    public function getStudent(): ?User
    {
        return $this->student;
    }

    public function setStudent(?User $student): static
    {
        $this->student = $student;

        return $this;
    }

    public function getDocent(): ?User
    {
        return $this->docent;
    }

    public function setDocent(?User $docent): static
    {
        $this->docent = $docent;

        return $this;
    }
}
