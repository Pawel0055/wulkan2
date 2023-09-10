<?php

namespace App\Component\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class DatesValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Dates) {
            throw new UnexpectedTypeException($constraint, Dates::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $pattern = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';

        preg_match($pattern, $value);

        if (!preg_match($pattern, $value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}