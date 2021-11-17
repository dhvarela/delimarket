<?php

namespace App\Market\Product\Domain;

use App\Market\Shared\Domain\ValueObject\IntValueObject;

final class Amount extends IntValueObject
{
    private const DECIMALS = 2;

    public function getWithCents(): float
    {
        return $this->value / (10 ** self::DECIMALS);
    }
}