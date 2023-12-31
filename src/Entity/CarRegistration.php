<?php

namespace App\Entity;

use App\Repository\CarRegistrationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRegistrationRepository::class)]
class CarRegistration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $siret = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $bill_date = null;

    #[ORM\ManyToOne(inversedBy: 'CarRegistration')]
    private ?User $user = null;

    #[ORM\OneToOne(mappedBy: 'CarRegistration', cascade: ['persist', 'remove'])]
    private ?Garage $garage = null;

    #[ORM\OneToOne(mappedBy: 'CarRegistration', cascade: ['persist', 'remove'])]
    private ?Car $car = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getBillDate(): ?\DateTimeInterface
    {
        return $this->bill_date;
    }

    public function setBillDate(\DateTimeInterface $bill_date): static
    {
        $this->bill_date = $bill_date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): static
    {
        // unset the owning side of the relation if necessary
        if ($garage === null && $this->garage !== null) {
            $this->garage->setCarRegistration(null);
        }

        // set the owning side of the relation if necessary
        if ($garage !== null && $garage->getCarRegistration() !== $this) {
            $garage->setCarRegistration($this);
        }

        $this->garage = $garage;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): static
    {
        // unset the owning side of the relation if necessary
        if ($car === null && $this->car !== null) {
            $this->car->setCarRegistration(null);
        }

        // set the owning side of the relation if necessary
        if ($car !== null && $car->getCarRegistration() !== $this) {
            $car->setCarRegistration($this);
        }

        $this->car = $car;

        return $this;
    }
}
