<?php

namespace App\Component\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class TimesValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Times) {
            throw new UnexpectedTypeException($constraint, Times::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $pattern = '/^([0-1][0-9]|2[0-3]):[0-5][0-9]$/';

        preg_match($pattern, $value);

        if (!preg_match($pattern, $value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}