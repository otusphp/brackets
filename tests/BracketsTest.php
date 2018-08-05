<?php

declare(strict_types=1);

namespace OtusPHP\Tests;

use OtusPHP\Brackets;
use PHPUnit\Framework\TestCase;

class BracketsTest extends TestCase
{
    /**
     * @param $str string
     * @param $expected bool
     *
     * @dataProvider providerValidate
     */
    public function testValidate($str, $expected): void
    {
        $result = (new Brackets($str))->validate();
        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function providerValidate(): array
    {
        return array (
            array ('({)(})', false),
            array ('(){}[]', true),
            array ('({[]})', true),
            array ('({[]})', true),
            array ('({[{}]})', true),
            array (']()({[]}){}', false),
            array ('()({[]}){}', true),
        );
    }

    public function testCannotBeValidatedWithNotAvailableCharacters(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        (new Brackets('{string}'))->validate();
    }
}