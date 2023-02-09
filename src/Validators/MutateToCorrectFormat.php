<?php

namespace Kdabrow\Math\Validators;

class MutateToCorrectFormat extends AbstractValidator
{
    protected function processing(string $number): string
    {
        $number = str_replace(" ", "", $number);

        if (str_starts_with($number, ".")) {
            return "0".$number;
        }

        if (str_starts_with($number, ",")) {
            return str_replace(",", "0.", $number);
        }

        if (str_contains($number, ",") && str_contains($number, ".")) {
            return str_replace(",", "", $number);
        }

        if (str_contains($number, ",")) {
            return str_replace(",", ".", $number);
        }

        if (str_contains($number, "'")) {
            return str_replace("'", "", $number);
        }

        return $number;
    }
}