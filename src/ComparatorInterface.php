<?php

declare(strict_types=1);

namespace Ordinary\Comparator;

interface ComparatorInterface
{
    public function compare(mixed $left, mixed $right): Ordering;
}
