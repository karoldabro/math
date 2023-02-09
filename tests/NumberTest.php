<?php

namespace Kdabrow\Math\Tests;

use Kdabrow\Math\Number;
use Kdabrow\Math\ValidationException;
use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{
    /** @test */
    public function can_add_numbers_using_number_api()
    {
        $number = new Number('100');

        $result = $number->add('200', '1')->add(['300', '100'])->add(new Number('400'));

        $this->assertEquals('1101', $result);
    }

    /** @test */
    public function can_subtract_numbers_using_number_api()
    {
        $number = new Number('100');

        $result = $number->subtract('200', '1')->subtract(['200', '100'])->subtract(new Number('300'));

        $this->assertEquals('-701', $result);
    }

    /** @test */
    public function can_multiply_numbers_using_number_api()
    {
        $number = new Number('100');

        $result = $number->multiply('2', '2')->multiply(['2', '0.75'])->multiply(new Number('3'));

        $this->assertEquals('1800', $result);
    }

    /** @test */
    public function can_divide_numbers_using_number_api()
    {
        $number = new Number('100');

        $result = $number->divide('2')->divide(['2', '0.75'])->divide(new Number('3'));

        $this->assertEquals('11.11', $result);
    }

    /** @test */
    public function can_perform_different_operations_on_the_same_number()
    {
        $number = new Number('100');

        $result = $number->subtract('200', new Number('300'))->add(['1000']);

        $this->assertEquals('600', $result);
    }

    /** @test */
    public function can_preform_square_root_calculation_using_number_api()
    {
        $number = new Number('100');

        $result = $number->subtract('36')->sqrt();

        $this->assertEquals('8', $result);
    }

    /** @test */
    public function can_power_numbers_using_number_api()
    {
        $number = new Number('2');

        $result = $number->pow('2')->pow(['3'])->pow(new Number('2'));

        $this->assertEquals('4096', $result);
    }

    /** @test */
    public function can_check_if_number_is_equal_to_other_number()
    {
        $number = new Number('100');

        $this->assertTrue($number->isEqual(['100', new Number('100')]));
    }

    /** @test */
    public function can_check_if_number_is_equal_or_bigger_to_other_number()
    {
        $number = new Number('100');

        $this->assertTrue($number->isEqualOrBigger(['100', new Number('101')]));
    }

    /** @test */
    public function can_check_if_number_is_equal_or_lower_to_other_number()
    {
        $number = new Number('100');

        $this->assertTrue($number->isEqualOrLower(['100', new Number('99')]));
    }

    /** @test */
    public function can_check_if_number_is_bigger_to_other_number()
    {
        $number = new Number('100');

        $this->assertTrue($number->isBigger(['101', new Number('101')]));
    }

    /** @test */
    public function can_check_if_number_is_lower_to_other_number()
    {
        $number = new Number('100');

        $this->assertTrue($number->isLower(['99', new Number('98')]));
    }

    /** @test */
    public function throws_exception_when_not_a_numeric_string_is_provided()
    {
        $this->expectException(ValidationException::class);

        new Number('test');
    }

    /** @test */
    public function throws_exception_when_not_a_numeric_string_is_provided_into_method_input()
    {
        $this->expectException(ValidationException::class);

        $number = new Number('100');

        $number->add(['100', 'test']);
    }

    /**
     * @test
     * @dataProvider provider_accept_different_number_formats
     */
    public function accept_different_number_formats(string $number)
    {
        $number = new Number($number);

        $this->assertEquals('10000000.01111111', $number->value);
    }

    public function provider_accept_different_number_formats()
    {
        return [
            ['10000000.01111111'],
            ['10000000,01111111'],
            ['10,000,000.01111111'],
        ];
    }
}