<?php

namespace Kdabrow\Math;

use ArrayAccess;
use Kdabrow\Math\Contracts\CalculatorInterface;
use Kdabrow\Math\Contracts\ComparatorInterface;
use Kdabrow\Math\Validators\AbstractValidator;
use Kdabrow\Math\Validators\IsNumericStringValidator;
use Kdabrow\Math\Validators\MutateToCorrectFormat;
use Stringable;

class Number implements Stringable
{
    public string $value;

    private CalculatorInterface $calculator;

    private ComparatorInterface $comparator;

    public function __construct(
        string $value = '0',
        public int $precision = 2,
        ?CalculatorInterface $calculator = null,
        ?ComparatorInterface $comparator = null,
        private readonly AbstractValidator $validator = new IsNumericStringValidator(new MutateToCorrectFormat()),
    ) {
        $this->value = $validator->handle($value);
        $this->calculator = $calculator ?? new BcCalculator($this);
        $this->comparator = $comparator ?? new BcComparator($this);
    }

    /**
     * @param string[]|Number[]|ArrayAccess|string|Number ...$numbers
     */
    public function add(array|ArrayAccess|string|Number ...$numbers): self
    {
        return $this->calculator->add(Input::normalize($numbers, $this->argumentCallback()));
    }

    /**
     * @param string[]|Number[]|ArrayAccess|string|Number ...$numbers
     */
    public function subtract(array|ArrayAccess|string|Number ...$numbers): self
    {
        return $this->calculator->subtract(Input::normalize($numbers, $this->argumentCallback()));
    }

    /**
     * @param string[]|Number[]|ArrayAccess|string|Number ...$numbers
     */
    public function multiply(array|ArrayAccess|string|Number ...$numbers): self
    {
        return $this->calculator->multiply(Input::normalize($numbers, $this->argumentCallback()));
    }

    /**
     * @param string[]|Number[]|ArrayAccess|string|Number ...$numbers
     */
    public function divide(array|ArrayAccess|string|Number ...$numbers): self
    {
        return $this->calculator->divide(Input::normalize($numbers, $this->argumentCallback()));
    }

    public function sqrt(): self
    {
        return $this->calculator->sqrt();
    }

    /**
     * @param string[]|Number[]|ArrayAccess|string|Number ...$numbers
     */
    public function pow(array|ArrayAccess|string|Number ...$numbers): self
    {
        return $this->calculator->pow(Input::normalize($numbers, $this->argumentCallback()));
    }

    /**
     * @param string[]|Number[]|ArrayAccess|string|Number ...$numbers
     */
    public function isEqual(array|ArrayAccess|string|Number ...$numbers): bool
    {
        return $this->comparator->isEqual(Input::normalize($numbers, $this->argumentCallback()));
    }

    /**
     * @param string[]|Number[]|ArrayAccess|string|Number ...$numbers
     */
    public function isEqualOrBigger(array|ArrayAccess|string|Number ...$numbers): bool
    {
        return $this->comparator->isEqualOrBigger(Input::normalize($numbers, $this->argumentCallback()));
    }

    /**
     * @param string[]|Number[]|ArrayAccess|string|Number ...$numbers
     */
    public function isEqualOrLower(array|ArrayAccess|string|Number ...$numbers): bool
    {
        return $this->comparator->isEqualOrLower(Input::normalize($numbers, $this->argumentCallback()));
    }

    /**
     * @param string[]|Number[]|ArrayAccess|string|Number ...$numbers
     */
    public function isBigger(array|ArrayAccess|string|Number ...$numbers): bool
    {
        return $this->comparator->isBigger(Input::normalize($numbers, $this->argumentCallback()));
    }

    /**
     * @param string[]|Number[]|ArrayAccess|string|Number ...$numbers
     */
    public function isLower(array|ArrayAccess|string|Number ...$numbers): bool
    {
        return $this->comparator->isLower(Input::normalize($numbers, $this->argumentCallback()));
    }

    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * Copy Number
     * @param string $value
     * @param int $precision
     * @return $this
     */
    public function copy(string $value = '0', int $precision = 2): self
    {
        return new self(
            $value,
            $precision,
            $this->calculator,
            $this->comparator,
            $this->validator
        );
    }

    /**
     * Creates array of Number elements. Basically to apply validation to each element
     * @return callable
     */
    protected function argumentCallback(): callable
    {
        return fn($argument) => $argument instanceof Number 
            ? $argument
            : $this->copy($argument, $this->precision);
    }
}