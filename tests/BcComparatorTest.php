<?php

namespace Kdabrow\Math\Tests;

use Kdabrow\Math\BcComparator;
use Kdabrow\Math\Number;
use PHPUnit\Framework\TestCase;

class BcComparatorTest extends TestCase
{
    /** @test */
    public function return_true_when_two_numbers_are_equal()
    {
        $calculator = new BcComparator(new Number('100'));

        $this->assertTrue($calculator->isEqual(['100']));
    }

    /** @test */
    public function return_false_when_two_numbers_are_not_equal()
    {
        $calculator = new BcComparator(new Number('100'));

        $this->assertFalse($calculator->isEqual(['-100']));
    }

    /** @test */
    public function return_true_when_all_compared_numbers_are_equal()
    {
        $calculator = new BcComparator(new Number('100'));

        $this->assertTrue($calculator->isEqual(['100', '100']));
    }

    /** @test */
    public function return_false_when_at_lest_one_of_compared_numbers_is_not_equal()
    {
        $calculator = new BcComparator(new Number('100'));

        $this->assertFalse($calculator->isEqual(['100', '-100']));
    }

    /** @test */
    public function return_true_when_number_is_bigger_or_equal()
    {
        $calculator = new BcComparator(new Number('100'));

        $this->assertTrue($calculator->isEqualOrBigger(['100']));
        $this->assertTrue($calculator->isEqualOrBigger(['101']));
    }

    /** @test */
    public function return_false_when_number_is_lower()
    {
        $calculator = new BcComparator(new Number('100'));

        $this->assertFalse($calculator->isEqualOrBigger(['99']));
    }

    /** @test */
    public function return_true_when_number_is_lower_or_equal()
    {
        $calculator = new BcComparator(new Number('100'));

        $this->assertTrue($calculator->isEqualOrLower(['100']));
        $this->assertTrue($calculator->isEqualOrLower(['99']));
    }

    /** @test */
    public function return_false_when_number_is_bigger()
    {
        $calculator = new BcComparator(new Number('100'));

        $this->assertFalse($calculator->isEqualOrLower(['101']));
    }

    /** @test */
    public function return_true_when_number_is_bigger()
    {
        $calculator = new BcComparator(new Number('100'));

        $this->assertTrue($calculator->isBigger(['101']));
    }

    /** @test */
    public function return_false_when_number_is_lower_or_equal()
    {
        $calculator = new BcComparator(new Number('100'));

        $this->assertFalse($calculator->isBigger(['100']));
        $this->assertFalse($calculator->isBigger(['99']));
    }
}