<?php

namespace App\Component\Validator\Constraints;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Dates extends Constraint
{
    public string $message = "Niepoprawny format daty";
}