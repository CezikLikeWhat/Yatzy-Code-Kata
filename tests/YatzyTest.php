<?php

declare(strict_types=1);

namespace Yatzy\Tests;

use PHPUnit\Framework\TestCase;
use Yatzy\Roll;
use Yatzy\YatzyGame;

class YatzyTest extends TestCase
{
    public function testOnes(): void
    {
        $yatzy = new YatzyGame(new Roll(1, 2, 3, 4, 5));
        self::assertSame(1, $yatzy->ones());
        $yatzy = new YatzyGame(new Roll(1, 2, 1, 4, 5));
        self::assertSame(2, $yatzy->ones());
        $yatzy = new YatzyGame(new Roll(6, 2, 2, 4, 5));
        self::assertSame(0, $yatzy->ones());
        $yatzy = new YatzyGame(new Roll(1, 2, 1, 1, 1));
        self::assertSame(4, $yatzy->ones());
    }

    public function testTwos(): void
    {
        $yatzy = new YatzyGame(new Roll(1, 2, 3, 2, 6));
        self::assertSame(4, $yatzy->twos());
        $yatzy = new YatzyGame(new Roll(2, 2, 2, 2, 2));
        self::assertSame(10, $yatzy->twos());
    }

    public function testThrees(): void
    {
        $yatzy = new YatzyGame(new Roll(1, 2, 3, 2, 3));
        self::assertSame(6, $yatzy->threes());
        $yatzy = new YatzyGame(new Roll(2, 3, 3, 3, 3));
        self::assertSame(12, $yatzy->threes());
    }

    public function testFours(): void
    {
        $yatzy = new YatzyGame(new Roll(4, 4, 4, 5, 5));
        self::assertSame(12, $yatzy->fours());
        $yatzy = new YatzyGame(new Roll(4, 4, 5, 5, 5));
        self::assertSame(8, $yatzy->fours());
        $yatzy = new YatzyGame(new Roll(4, 5, 5, 5, 5));
        self::assertSame(4, $yatzy->fours());
    }

    public function testFives(): void
    {
        $yatzy = new YatzyGame(new Roll(4, 4, 4, 5, 5));
        self::assertSame(10, $yatzy->fives());
        $yatzy = new YatzyGame(new Roll(4, 4, 5, 5, 5));
        self::assertSame(15, $yatzy->fives());
        $yatzy = new YatzyGame(new Roll(4, 5, 5, 5, 5));
        self::assertSame(20, $yatzy->fives());
    }

    public function testSixes(): void
    {
        $yatzy = new YatzyGame(new Roll(4, 4, 4, 5, 5));
        self::assertSame(0, $yatzy->sixes());
        $yatzy = new YatzyGame(new Roll(4, 4, 6, 5, 5));
        self::assertSame(6, $yatzy->sixes());
        $yatzy = new YatzyGame(new Roll(6, 5, 6, 6, 5));
        self::assertSame(18, $yatzy->sixes());
    }

    public function testChance(): void
    {
        $yatzy = new YatzyGame(new Roll(2, 3, 4, 5, 1));
        self::assertSame(15, $yatzy->chance());
        $yatzy = new YatzyGame(new Roll(3, 3, 4, 5, 1));
        self::assertSame(16, $yatzy->chance());
    }

    public function testYatzyScore(): void
    {
        $yatzy = new YatzyGame(new Roll(4, 4, 4, 4, 4));
        self::assertSame(50, $yatzy->yatzyScore());
        $yatzy = new YatzyGame(new Roll(6, 6, 6, 6, 6));
        self::assertSame(50, $yatzy->yatzyScore());
        $yatzy = new YatzyGame(new Roll(6, 6, 6, 6, 3));
        self::assertSame(0, $yatzy->yatzyScore());
    }

    public function testPairOfOne(): void
    {
        $yatzy = new YatzyGame(new Roll(3, 4, 3, 5, 6));
        self::assertSame(6, $yatzy->pairOfOne());
        $yatzy = new YatzyGame(new Roll(5, 3, 3, 3, 5));
        self::assertSame(10, $yatzy->pairOfOne());
        $yatzy = new YatzyGame(new Roll(5, 3, 6, 6, 5));
        self::assertSame(12, $yatzy->pairOfOne());
    }

    public function testPairOfTwo(): void
    {
        $yatzy = new YatzyGame(new Roll(3, 3, 5, 4, 5));
        self::assertSame(16, $yatzy->pairOfTwo());
        $yatzy = new YatzyGame(new Roll(3, 3, 6, 6, 6));
        self::assertSame(18, $yatzy->pairOfTwo());
        $yatzy = new YatzyGame(new Roll(3, 3, 6, 5, 4));
        self::assertSame(0,  $yatzy->pairOfTwo());
    }

    public function testThreeOfAKind(): void
    {
        $yatzy = new YatzyGame(new Roll(3, 3, 3, 4, 5));
        self::assertSame(9,  $yatzy->threeOfAKind());
        $yatzy = new YatzyGame(new Roll(5, 3, 5, 4, 5));
        self::assertSame(15, $yatzy->threeOfAKind());
        $yatzy = new YatzyGame(new Roll(3, 3, 3, 2, 1));
        self::assertSame(9,  $yatzy->threeOfAKind());
    }

    public function testSmallStraight(): void
    {
        $yatzy = new YatzyGame(new Roll(1, 2, 3, 4, 5));
        self::assertSame(15, $yatzy->smallStraight());
        $yatzy = new YatzyGame(new Roll(2, 3, 4, 5, 1));
        self::assertSame(15, $yatzy->smallStraight());
        $yatzy = new YatzyGame(new Roll(1, 2, 2, 4, 5));
        self::assertSame(0,  $yatzy->smallStraight());
    }

    public function testLargeStraight(): void
    {
        $yatzy = new YatzyGame(new Roll(6, 2, 3, 4, 5));
        self::assertSame(20, $yatzy->largeStraight());
        $yatzy = new YatzyGame(new Roll(2, 3, 4, 5, 6));
        self::assertSame(20, $yatzy->largeStraight());
        $yatzy = new YatzyGame(new Roll(1, 2, 2, 4, 5));
        self::assertSame(0,  $yatzy->largeStraight());
    }

    public function testFullHouse(): void
    {
        $yatzy = new YatzyGame(new Roll(6, 2, 2, 2, 6));
        self::assertSame(18, $yatzy->fullHouse());
        $yatzy = new YatzyGame(new Roll(2, 3, 4, 5, 6));
        self::assertSame(0,  $yatzy->fullHouse());
    }
}
