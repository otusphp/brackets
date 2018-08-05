<?php

declare(strict_types=1);

namespace OtusPHP;

class Brackets
{
    /**
     * @var array
     */
    public static $availableCharacters = ['(', ')', '[', ']', '{', '}', ' ', '\n', '\t', '\r'];

    /**
     * @var array
     */
    public static $bracketsPairs = [
        ')' => '(',
        ']' => '[',
        '}' => '{',
    ];

    /**
     * @var string
     */
    private $str;

    /**
     * Brackets constructor.
     * @param string $str
     */
    public function __construct(string $str)
    {
        $this->str = $str;
    }

    /**
     * @throws \InvalidArgumentException
     *
     * @return bool
     */
    public function validate(): bool
    {
        $len = mb_strlen($this->str);
        $a = [];
        for ($i = 0; $i < $len; $i++) {
            if (!\in_array($this->str[$i], static::$availableCharacters, false)) {
                throw new \InvalidArgumentException('String contains not available character');
            }

            if (\in_array($this->str[$i], static::$bracketsPairs, true)) {
                $a[] = $this->str[$i];
            } elseif (array_key_exists($this->str[$i], static::$bracketsPairs)) {
                $b = array_pop($a);

                if ($b !== static::$bracketsPairs[$this->str[$i]]) {
                    return false;
                }
            }
        }

        return \count($a) === 0;
    }
}