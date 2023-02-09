<?php

namespace Kdabrow\Math\Tests\Validators;

use Kdabrow\Math\Validators\MutateToCorrectFormat;
use PHPUnit\Framework\TestCase;

class MutateToCorrectFormatTest extends TestCase
{
    /** @test */
    public function input_without_decimal_stays_the_same()
    {
        $mutator = new MutateToCorrectFormat();

        $this->assertEquals('10000000', $mutator->handle('10000000'));
    }

    /**
     * @test
     * @dataProvider provider_mutate_decimal_input_into_correct_format
    */
    public function mutate_decimal_input_into_correct_format(string $number)
    {
        $mutator = new MutateToCorrectFormat();

        $this->assertEquals('10000000.01111111', $mutator->handle($number));
    }

    public function provider_mutate_decimal_input_into_correct_format(): array
    {
        return [
            ['10000000.01111111'],
            ['10000000,01111111'],
            ['10,000,000.01111111'],
            ['10 000 000.01111111'],
            ['10 000 000.01 111 111'],
            ['10\'000\'000.01 111 111'],
        ];
    }


    /**
     * @test
     * @dataProvider provider_mutate_only_decimal_input_into_correct_format
     */
    public function mutate_only_decimal_input_into_correct_format(string $number)
    {
        $mutator = new MutateToCorrectFormat();

        $this->assertEquals('0.01111111', $mutator->handle($number));
    }

    public function provider_mutate_only_decimal_input_into_correct_format(): array
    {
        return [
            ['0.01111111'],
            ['0,01111111'],
            ['.01111111'],
            [',01111111'],
        ];
    }
}