<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // ManyToOne: The User who created the reservation
    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    // ManyToOne: The Barber that is being reserved
    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Barber $barber = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $requestedTime = null;

    #[ORM\Column(length: 255)]
    private ?string $service = null;

    #[ORM\Column(length: 50)]
    private string $status = 'pending'; // 'pending', 'accepted', 'rejected', 'completed'

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBarber(): ?Barber
    {
        return $this->barber;
    }

    public function setBarber(?Barber $barber): static
    {
        $this->barber = $barber;
        return $this;
    }

    public function getRequestedTime(): ?\DateTimeInterface
    {
        return $this->requestedTime;
    }

    public function setRequestedTime(\DateTimeInterface $requestedTime): static
    {
        // Changed to use DateTimeImmutable for best practice, adjust if you prefer mutable
        if ($requestedTime instanceof \DateTimeImmutable) {
             $this->requestedTime = $requestedTime;
        } else {
             $this->requestedTime = \DateTimeImmutable::createFromMutable($requestedTime);
        }
        return $this;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service): static
    {
        $this->service = $service;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;
        return $this;
    }
}