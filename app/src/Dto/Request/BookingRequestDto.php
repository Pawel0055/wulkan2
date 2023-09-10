<?php

namespace App\Dto\Request;

use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Component\Validator\Constraints as CustomAssert;

class BookingRequestDto
{
    #[CustomAssert\Times]
    private ?string $time = null;

    private ?string $registrationNumber = null;

    #[CustomAssert\Dates]
    private ?string $date = null;

    public function getRegistrationNumber(): ?string
    {
        return $this->registrationNumber;
    }

    public function setRegistrationNumber(?string $registrationNumber): self
    {
        $this->registrationNumber = $registrationNumber;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(?string $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }
}
