<?php

namespace App\Market\Shared\Infrastructure\Exception;

use RuntimeException;

final class JsonBodyRequestNotValid extends RuntimeException
{
    public static function throw()
    {
        throw new self("The request has an invalid Json body");
    }
}