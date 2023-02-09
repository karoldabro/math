<?php

namespace Kdabrow\Math\Validators;

use Kdabrow\Math\ValidationException;

class IsNumericStringValidator extends AbstractValidator
{
    protected function processing(string $number): string
    {
        if (preg_match("/^-?[\d|\s|,|\.|'|\d]*?$/", $number) == false) {
            throw new ValidationException("Provided value: \"$number\" is not numeric string");
        }

        return $number;
    }
}