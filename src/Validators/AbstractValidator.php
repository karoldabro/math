<?php

namespace Kdabrow\Math\Validators;

abstract class AbstractValidator
{
    public function __construct(private ?AbstractValidator $successor = null)
    {
    }

    final public function handle(string $number): string
    {
        $number = $this->processing($number);

        if ($this->successor !== null) {
            $number = $this->successor->handle($number);
        }

        return $number;
    }

    /**
     * Method implementing validation or mutation of the input
     *
     * @param string $number
     * @return string
     */
    abstract protected function processing(string $number): string;
}