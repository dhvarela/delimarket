<?php

namespace App\Market\Category\Domain;

use App\Market\Shared\Domain\Exception\DomainError;
use App\Market\Shared\Domain\Exception\InternalErrorCodes;

final class CategoryNotFound extends DomainError
{
    public static function throw(): void
    {
        throw new self('The category was not found', InternalErrorCodes::ENTITY_NOT_FOUND);
    }
}