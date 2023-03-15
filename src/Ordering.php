<?php

declare(strict_types=1);

namespace Ordinary\Comparator;

enum Ordering: int
{
    case Less = -1;
    case Equal = 0;
    case Greater = 1;

    public const LEFT = self::Less;

    public const RIGHT = self::Greater;

    public static function fromInt(int $order): self
    {
        return match (true) {
            $order < 0 => self::Less,
            $order > 0 => self::Greater,
            default => self::Equal,
        };
    }

    public function inverse(): self
    {
        return match ($this) {
            self::Less => self::Greater,
            self::Greater => self::Less,
            self::Equal => self::Equal,
        };
    }
}
