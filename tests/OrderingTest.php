<?php

declare(strict_types=1);

namespace Ordinary\Comparator;

use Generator;
use PHPUnit\Framework\TestCase;

class OrderingTest extends TestCase
{
    public static function orderingIntegerProvider(): Generator
    {
        foreach (Ordering::cases() as $ordering) {
            yield [$ordering->value, $ordering];
        }

        yield [999, Ordering::Greater];

        yield [-999, Ordering::Less];
    }

    public static function inverseProvider(): Generator
    {
        foreach (Ordering::cases() as $ordering) {
            yield [$ordering, match ($ordering) {
                Ordering::Less => Ordering::Greater,
                Ordering::Greater => Ordering::Less,
                Ordering::Equal => Ordering::Equal,
            }];
        }
    }

    /** @dataProvider orderingIntegerProvider */
    public function testFromInt(int $value, Ordering $ordering): void
    {
        self::assertSame($ordering, Ordering::fromInt($value));
    }

    /** @dataProvider inverseProvider */
    public function testInverse(Ordering $order, Ordering $expectedInverse): void
    {
        self::assertSame($expectedInverse, $order->inverse());
    }
}
