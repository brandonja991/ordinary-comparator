<?php

declare(strict_types=1);

namespace Ordinary\Comparator;

use Generator;
use PHPUnit\Framework\TestCase;

class ComparatorTest extends TestCase
{
    /** @return Generator<array{0: mixed, 1: mixed, 2: Ordering}> */
    public function defaultComparatorProvider(): Generator
    {
        yield [0, 0, Ordering::Equal];

        yield [0, 1, Ordering::Less];
        yield [0, 1, Ordering::Less];

        yield [0, -1, Ordering::Greater];
    }

    public function defaultComparatorProviderWithInverse(): Generator
    {
        foreach ($this->defaultComparatorProvider() as $provided) {
            yield $provided;
            yield [$provided[1], $provided[0], $provided[2]->inverse()];
        }
    }

    /** @dataProvider defaultComparatorProviderWithInverse */
    public function testDefaultComparator(mixed $left, mixed $right, Ordering $result): void
    {
        $comparator = new Comparator();

        self::assertSame($result, $comparator->compare($left, $right));
        self::assertSame($result->value, $comparator($left, $right));
    }
}
