<?php

namespace App\Market\Product\Domain;

use App\Market\Shared\Domain\Exception\DomainError;
use App\Market\Shared\Domain\Exception\InternalErrorCodes;

final class ProductNotFound extends DomainError
{
    public static function throw(): void
    {
        throw new self('The product was not found', InternalErrorCodes::ENTITY_NOT_FOUND);
    }
}