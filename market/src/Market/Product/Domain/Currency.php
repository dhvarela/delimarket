<?php

declare(strict_types=1);

namespace App\Market\Product\Domain;

use App\Market\Shared\Domain\ValueObject\StringValueObject;

final class Currency extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->ensureIsoCode($value);

        parent::__construct($value);
    }

    private function ensureIsoCode(string $value): void
    {
        if (!preg_match('/^[A-Z]{3}$/', $value)) {
            throw new \InvalidArgumentException('The currency iso code length must be 3');
        }
        $this->value = $value;
    }

    public function equals(Currency $currency): bool
    {
        return $currency->value === $this->value();
    }
}