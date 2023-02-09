<?php

namespace Kdabrow\Math\Contracts;

use Kdabrow\Math\Number;

interface ComparatorInterface
{
    /**
     * @param Number[] $numbers
     */
    public function isEqual(array $numbers): bool;

    /**
     * @param Number[] $numbers
     */
    public function isEqualOrBigger(array $numbers): bool;

    /**
     * @param Number[] $numbers
     */
    public function isEqualOrLower(array $numbers): bool;

    /**
     * @param Number[] $numbers
     */
    public function isBigger(array $numbers): bool;

    /**
     * @param Number[] $numbers
     */
    public function isLower(array $numbers): bool;
}