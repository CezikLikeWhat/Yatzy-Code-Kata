<?php

declare(strict_types=1);

namespace Yatzy;

class YatzyGame
{
    public function __construct(
        public Roll $roll
    ) {
    }

    public function ones(): int
    {
        return $this->arraySumOfSpecificNumber(1);
    }

    public function twos(): int
    {
        return $this->arraySumOfSpecificNumber(2);
    }

    public function threes(): int
    {
        return $this->arraySumOfSpecificNumber(3);
    }

    public function fours(): int
    {
        return $this->arraySumOfSpecificNumber(4);
    }

    public function fives(): int
    {
        return $this->arraySumOfSpecificNumber(5);
    }

    public function sixes(): int
    {
        return $this->arraySumOfSpecificNumber(6);
    }

    public function chance(): int
    {
        return array_sum($this->roll->toArray());
    }

    public function yatzyScore(): int
    {
        return count(array_unique($this->roll->toArray())) === 1 ? 50 : 0;
    }

    public function pairOfOne(): int
    {
        $counts = $this->getReverseSortedArrayOfCountedElements();

        foreach ($counts as $value => $count) {
            if ($count >= 2) {
                return $value * 2;
            }
        }

        return 0;
    }

    public function pairOfTwo(): int
    {
        $counts = $this->getReverseSortedArrayOfCountedElements();
        $pairs = 0;
        $score = 0;

        foreach ($counts as $value => $count) {
            if ($count >= 2) {
                $score += $value * 2;
                $pairs++;

                if ($pairs == 2) {
                    return $score;
                }
            }
        }

        return 0;
    }

    public function threeOfAKind(): int
    {
        $counts = $this->getReverseSortedArrayOfCountedElements();

        foreach ($counts as $value => $count) {
            if ($count >= 3) {
                return $value * 3;
            }
        }

        return 0;
    }

    public function smallStraight(): int
    {
        $arrayOfRolls = $this->roll->toArray();
        sort($arrayOfRolls);
        return $arrayOfRolls === [1, 2, 3, 4, 5] ? 15 : 0;
    }

    public function largeStraight(): int
    {
        $arrayOfRolls = $this->roll->toArray();
        sort($arrayOfRolls);
        return $arrayOfRolls === [2, 3, 4, 5, 6] ? 20 : 0;
    }

    public function fullHouse(): int
    {
        $counts = array_count_values($this->roll->toArray());
        $hasTwo = false;
        $hasThree = false;
        $score = 0;

        foreach ($counts as $value => $count) {
            if ($count == 2) {
                $hasTwo = true;
                $score += $value * 2;
            } elseif ($count == 3) {
                $hasThree = true;
                $score += $value * 3;
            }
        }

        return $hasTwo && $hasThree ? $score : 0;
    }

    private function arraySumOfSpecificNumber(int $number): int
    {
        $sum = 0;
        foreach ($this->roll->toArray() as $die) {
            if ($die == $number) {
                $sum += $number;
            }
        }
        return $sum;
    }

    /**
     * @return int[]
     */
    private function getReverseSortedArrayOfCountedElements(): array
    {
        $counts = array_count_values($this->roll->toArray());
        ksort($counts);
        return array_reverse($counts, true);
    }
}
