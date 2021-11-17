<?php

declare(strict_types=1);

namespace App\Market\Product\Domain;

use App\Market\Shared\Domain\Exception\DomainInvalidArgument;
use App\Market\Shared\Domain\ValueObject\StringValueObject;

final class ProductName extends StringValueObject
{
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 100;

    public function __construct(string $value)
    {
        $this->ensureLength($value);

        parent::__construct($value);
    }

    private function ensureLength(string $value): void
    {
        if (strlen($value) < self::MIN_LENGTH) {
            DomainInvalidArgument::throw('The product name length can\'t be less than ' . self::MIN_LENGTH);
        }
        if (strlen($value) > self::MAX_LENGTH) {
            DomainInvalidArgument::throw('The product name length can\'t be greater than ' . self::MAX_LENGTH);
        }
    }
}
