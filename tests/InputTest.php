<?php

namespace Kdabrow\Math\Tests;

use Kdabrow\Math\Input;
use Kdabrow\Math\Number;
use PHPUnit\Framework\TestCase;

class InputTest extends TestCase
{
    /** @test */
    public function accept_one_array()
    {
        $result = Input::normalize(['100', '200', '300']);

        $this->assertEquals(['100', '200', '300'], $result);
    }

    /** @test */
    public function accept_many_arrays()
    {
        $result = Input::normalize([['100', '200', '300'], ['400', '500', '600']]);

        $this->assertEquals(['100', '200', '300', '400', '500', '600'], $result);
    }

    /** @test */
    public function accept_number_object()
    {
        $result = Input::normalize([new Number('100')]);

        $this->assertEquals(['100'], $result);
    }

    /** @test */
    public function accept_array_of_number_objects()
    {
        $result = Input::normalize([new Number('100'), new Number('200')]);

        $this->assertEquals(['100', '200'], $result);
    }

    /** @test */
    public function accept_mixed_arguments_with_number_object()
    {
        $result = Input::normalize([new Number('100'), new Number('200'), '300', ['400', '500'], '600', new Number('700')]);

        $this->assertEquals(['100', '200', '300', '400', '500', '600', '700'], $result);
    }

    /** @test */
    public function flatten_multidimensional_array()
    {
        $result = Input::normalize(['100', '200', ['300', ['400', ['500']]]]);

        $this->assertEquals(['100', '200', '300', '400', '500'], $result);
    }

    /** @test */
    public function apply_callback_to_each_element()
    {
        $result = Input::normalize(['100', '200', ['300', ['400', ['500']]]], fn($item) => "+$item");

        $this->assertEquals(['+100', '+200', '+300', '+400', '+500'], $result);
    }
}