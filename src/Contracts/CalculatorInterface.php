<?php

namespace Kdabrow\Math\Contracts;

use Kdabrow\Math\Number;

interface CalculatorInterface
{
    /**
     * @param Number[] $numbers
     */
    public function add(array $numbers): Number;

    /**
     * @param Number[] $numbers
     */
    public function subtract(array $numbers): Number;

    /**
     * @param Number[] $numbers
     */
    public function multiply(array $numbers): Number;

    /**
     * @param Number[] $numbers
     */
    public function divide(array $numbers): Number;

    public function sqrt(): Number;

    /**
     * @param Number[] $numbers
     */
    public function pow(array $numbers): Number;
}