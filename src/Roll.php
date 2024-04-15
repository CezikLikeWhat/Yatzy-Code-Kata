<?php

declare(strict_types=1);

namespace Yatzy;

use InvalidArgumentException;

class Roll {

    /**
     * @var int[]
     */
    private array $rolls;

    public function __construct(
        public readonly int $rollOne,
        public readonly int $rollTwo,
        public readonly int $rollThree,
        public readonly int $rollFour,
        public readonly int $rollFive,
    ) {
        $this->rolls = [$rollOne, $rollTwo, $rollThree, $rollFour, $rollFive];

        foreach ($this->rolls as $roll) {
            if ($roll < 1 || $roll > 6) {
                throw new InvalidArgumentException("Each roll must be between 1 and 6!");
            }
        }
    }

    /**
     * @param int[] $rolls
     */
    public static function fromArray(array $rolls): self
    {
        return new self(
            $rolls[0],
            $rolls[1],
            $rolls[2],
            $rolls[3],
            $rolls[4],
        );
    }

    /**
     * @return int[]
     */
    public function toArray(): array
    {
        return $this->rolls;
    }
}