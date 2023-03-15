<?php

declare(strict_types=1);

namespace Ordinary\Comparator;

use UnexpectedValueException as PHPUnexpectedValueException;

class UnexpectedValueException extends PHPUnexpectedValueException implements ComparatorException
{
}
