<?php

namespace App\Dto\Request;

use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Component\Validator\Constraints as CustomAssert;

class ReceptionRequestDto
{
    #[CustomAssert\Times]
    private ?string $time = null;

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(?string $time): self
    {
        $this->time = $time;

        return $this;
    }
}
