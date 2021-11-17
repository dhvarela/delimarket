<?php

namespace App\Market\Shared\Infrastructure\Response;

use Symfony\Component\HttpFoundation\Response;

final class ApiHttpNoContentResponse extends ApiHttpResponse
{
    public function __construct($data = null, array $headers = [])
    {
        parent::__construct($data, Response::HTTP_NO_CONTENT, $headers);
    }
}