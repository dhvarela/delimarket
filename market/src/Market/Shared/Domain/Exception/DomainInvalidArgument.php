<?php

namespace App\Market\Shared\Domain\Exception;

final class DomainInvalidArgument extends DomainError
{
    public static function throw($msg): void
    {
        throw new self($msg);
    }
}