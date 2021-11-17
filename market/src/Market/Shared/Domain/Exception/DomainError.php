<?php

namespace App\Market\Shared\Domain\Exception;

use DomainException;

abstract class DomainError extends DomainException
{
    private $internalErrorCode;

    public function __construct(string $message, string $internalErrorCode = InternalErrorCodes::INVALID_ARGUMENT)
    {
        $this->internalErrorCode = $internalErrorCode;
        parent::__construct($message);
    }

    public function internalErrorCode(): string
    {
        return $this->internalErrorCode;
    }
}

