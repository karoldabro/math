<?php

namespace Kdabrow\Math;

use Kdabrow\Math\Contracts\ComparatorInterface;

class BcComparator implements ComparatorInterface
{
    private Number $number;

    public function __construct(Number $number)
    {
        $this->number = $number;
    }

    /**
     * @inheritDoc
     */
    public function isEqual(array $numbers): bool
    {
        return $this->evaluate($numbers, fn ($result) => $result != 0);
    }

    /**
     * @inheritDoc
     */
    public function isEqualOrBigger(array $numbers): bool
    {
        return $this->evaluate($numbers, fn ($result) => $result == -1);
    }

    /**
     * @inheritDoc
     */
    public function isEqualOrLower(array $numbers): bool
    {
        return $this->evaluate($numbers, fn ($result) => $result == 1);
    }

    /**
     * @inheritDoc
     */
    public function isBigger(array $numbers): bool
    {
        return $this->evaluate($numbers, fn ($result) => $result == -1 || $result == 0);
    }

    /**
     * @inheritDoc
     */
    public function isLower(array $numbers): bool
    {
        return $this->evaluate($numbers, fn ($result) => $result == 1 || $result == 0);
    }

    /**
     * Performs comparison
     *
     * @param array|string|Number $numbers
     * @param callable $resultComparison When return true, function breaks the comparison of left numbers because the
     * basic logic condition for given comparison, is not meet
     * @return bool
     */
    protected function evaluate(array|string|Number $numbers, callable $resultComparison): bool
    {
        foreach ($numbers as $number) {
            if ($number instanceof Number) {
                $number = $number->value;
            }

            $result = bccomp($this->number->value, $number, $this->number->precision);

            if (call_user_func($resultComparison, $result)) {
                return false;
            }
        }

        return true;
    }
}