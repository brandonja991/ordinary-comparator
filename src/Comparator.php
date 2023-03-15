<?php

declare(strict_types=1);

namespace Ordinary\Comparator;

use Closure;

class Comparator implements ComparatorInterface
{
    private readonly Closure $comparator;

    public function __construct(callable|ComparatorInterface|null $comparator = null)
    {
        $comparator ??= static fn (mixed $left, mixed $right): int => $left <=> $right;
        $this->comparator = match (true) {
            $comparator instanceof Closure => $comparator,
            $comparator instanceof ComparatorInterface => $comparator->compare(...),
            default => $comparator(...),
        };
    }

    public function __invoke(mixed $left, mixed $right): int
    {
        return $this->compare($left, $right)->value;
    }

    public function compare(mixed $left, mixed $right): Ordering
    {
        $callable = $this->comparator;
        $result = $callable($left, $right);

        if ($result instanceof Ordering) {
            return $result;
        }

        if (is_int($result)) {
            return Ordering::fromInt($result);
        }

        throw new UnexpectedValueException('Unexpected comparator result type: ' . get_debug_type($result));
    }
}
