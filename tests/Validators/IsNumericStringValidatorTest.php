<?php

namespace Kdabrow\Math\Tests\Validators;

use Kdabrow\Math\ValidationException;
use Kdabrow\Math\Validators\IsNumericStringValidator;
use PHPUnit\Framework\TestCase;

class IsNumericStringValidatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider provider_throws_exception_when_non_numeric_string_is_provided
    */
    public function throws_exception_when_non_numeric_string_is_provided(string $string)
    {
        $this->expectException(ValidationException::class);

        $validator = new IsNumericStringValidator();

        $validator->handle($string);
    }

    public function provider_throws_exception_when_non_numeric_string_is_provided()
    {
        return [
            ['string'],
            ['test1'],
            ['1test'],
            ['$'],
            ['1E5'],
            ['text with 1000 some number inside'],
            ['xyz100,00xyz'],
            ['xyz100 00zyz'],
        ];
    }

    /**
     * @test
     * @dataProvider provider_accept_a_string_containing_a_number
     */
    public function accept_a_string_containing_a_number(string $string)
    {
        $validator = new IsNumericStringValidator();

        $this->assertEquals($string, $validator->handle($string));
    }

    public function provider_accept_a_string_containing_a_number()
    {
        return [
            ['-100'],
            ['-100,23'],
            ['-100.23'],
            ['0'],
            [' 0 '],
            ['100'],
            ['100.00'],
            ['100,11'],
            ['100.'],
            ['0.11'],
            ['0,11'],
            ['.11'],
            [',11'],
            ['10,000,000.01111111'],
            ["10'000'000.01111111"],
            ["10'000'000,01111111"],
            ["10 000 000,01111111"],
            ["10 000 000,01111111"],
        ];
    }
}