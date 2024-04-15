<?php

declare(strict_types=1);

namespace Yatzy\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yatzy\Roll;
use Yatzy\YatzyGame;

class RollTest extends TestCase
{
    public function testShouldThrowExceptionBecauseOneRollIsOutOfRange(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new YatzyGame(new Roll(4, 4, 4, 4, -1));
    }
}