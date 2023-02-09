<?php

namespace Kdabrow\Math;

use Kdabrow\Math\Contracts\CalculatorInterface;

class BcCalculator implements CalculatorInterface
{
    private Number $number;

    public function __construct(Number $number)
    {
        $this->number = $number;
    }

    /**
     * @inheritDoc
     */
    public function add(array $numbers): Number
    {
        return $this->recursiveCalculation('bcadd', $this->number, $numbers);
    }

    /**
     * @inheritDoc
     */
    public function subtract(array $numbers): Number
    {
        $numbers = array_reverse($numbers);

        return $this->recursiveCalculation('bcsub', $this->number, $numbers);
    }

    /**
     * @inheritDoc
     */
    public function multiply(array $numbers): Number
    {
        return $this->recursiveCalculation('bcmul', $this->number, $numbers);
    }

    /**
     * @inheritDoc
     */
    public function divide(array $numbers): Number
    {
        return $this->recursiveCalculation('bcdiv', $this->number, $numbers);
    }

    /**
     * @inheritDoc
     */
    public function sqrt(): Number
    {
        $this->number->value = bcsqrt($this->number->value, $this->number->precision);

        return $this->number;
    }

    /**
     * @inheritDoc
     */
    public function pow(array $numbers): Number
    {
        return $this->recursiveCalculation('bcpow', $this->number, $numbers);
    }

    protected function recursiveCalculation(
        string $functionName,
        Number $basicNumber,
        array|string|Number $numbers
    ): Number {
        if ($numbers instanceof Number) {
            $numbers = $numbers->value;
        }

        if (is_string($numbers)) {
            $basicNumber->value = call_user_func($functionName, $basicNumber, $numbers, $basicNumber->precision);

            return $basicNumber;
        }

        foreach ($numbers as $number) {
            $basicNumber->value = $this->recursiveCalculation($functionName, $basicNumber, $number);
        }

        return $basicNumber;
    }
}