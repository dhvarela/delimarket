<?php

namespace App\Market\Shared\Infrastructure\Service;

use App\Market\Shared\Infrastructure\Exception\JsonBodyRequestNotValid;
use Symfony\Component\HttpFoundation\RequestStack;

final class EnsureBodyRequestIsAValidJson
{
    private $request;

    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
    }

    public function execute()
    {
        if ($this->request->getContentType() !== 'json' || !$this->request->getContent()) {
            JsonBodyRequestNotValid::throw();
        }

        return json_decode($this->request->getContent(), false);
    }
}