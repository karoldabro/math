<?php

namespace Kdabrow\Math\Tests;

use Kdabrow\Math\BcCalculator;
use Kdabrow\Math\Number;
use Kdabrow\Math\ValidationException;
use PHPUnit\Framework\TestCase;

class BcCalculatorTest extends TestCase
{
    /** @test */
    public function can_add_single_number()
    {
        $calculator = new BcCalculator(new Number('100'));

        $result = $calculator->add(['200']);

        $this->assertEquals('300', $result);
    }

    /** @test */
    public function can_add_many_strings()
    {
        $calculator = new BcCalculator(new Number('100'));

        $result = $calculator->add(['200', '300', '400']);

        $this->assertEquals('1000', $result);
    }

    /** @test */
    public function can_sub_single_number()
    {
        $calculator = new BcCalculator(new Number('100'));

        $result = $calculator->subtract(['200']);

        $this->assertEquals('-100', $result);
    }

    /** @test */
    public function can_subtract_many_strings()
    {
        $calculator = new BcCalculator(new Number('100'));

        $result = $calculator->subtract(['200', '300', '400']);

        $this->assertEquals('-800', $result);
    }

    /** @test */
    public function can_multiply_many_numbers()
    {
        $calculator = new BcCalculator(new Number('100'));

        $result = $calculator->multiply(['2', '0.25']);

        $this->assertEquals('50', $result);
    }

    /** @test */
    public function can_divide_many_numbers()
    {
        $calculator = new BcCalculator(new Number('100'));

        $result = $calculator->divide(['2', '0.75']);

        $this->assertEquals('66.66', $result);
    }

    /** @test */
    public function can_square_root_many_numbers()
    {
        $calculator = new BcCalculator(new Number('64'));

        $result = $calculator->sqrt();

        $this->assertEquals('8', $result);
    }

    /** @test */
    public function can_power_many_numbers()
    {
        $calculator = new BcCalculator(new Number('2'));

        $result = $calculator->pow(['2', '3']);

        $this->assertEquals('64', $result);
    }
}