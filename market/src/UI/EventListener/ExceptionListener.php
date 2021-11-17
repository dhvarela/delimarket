<?php

namespace App\UI\EventListener;

use App\Market\Shared\Domain\Exception\DomainError;
use App\Market\Shared\Domain\Exception\InternalErrorCodes;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

/**
 * This listener receives ALL errors within the application and will always return the errors in a JSON format
 */
final class ExceptionListener
{
    private $environment;

    public function __construct(string $environment)
    {
        $this->environment = $environment;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $response = new JsonResponse();

        if ($exception instanceof DomainError) {
            $response->setStatusCode($this->buildHttpErrorCodeFromInternalErrorCode($exception->internalErrorCode()));
        } elseif ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($this->isProductionEnvironment()) {
            $response->setJson(json_encode($this->buildErrorMessageForProductionClient($exception)));
        } else {
            $response->setJson(json_encode($this->buildErrorMessage($exception)));
        }

        $event->setResponse($response);
    }

    private function buildErrorMessage(Exception $exception): array
    {
        $errorMessage = [];
        if ($exception instanceof DomainError) {
            $errorMessage['errorCode'] = $exception->internalErrorCode();
        } else {
            $errorMessage['errorCode'] = InternalErrorCodes::INTERNAL_SERVER_DRAMA;
        }

        $errorMessage['errorMessage'] = $exception->getMessage();
        $errorMessage['errorStackTrace'] = $exception->getTrace();

        return $errorMessage;
    }

    private function buildErrorMessageForProductionClient(Exception $exception): array
    {
        $errorMessage = $this->buildErrorMessage($exception);
        unset($errorMessage['errorStackTrace']);

        return $errorMessage;
    }

    private function isProductionEnvironment(): bool
    {
        return in_array($this->environment, ['pre', 'prod']);
    }

    private function buildHttpErrorCodeFromInternalErrorCode(string $internalErrorCode): string
    {
        switch ($internalErrorCode) {
            case InternalErrorCodes::ENTITY_NOT_FOUND:
                return Response::HTTP_NOT_FOUND;
            case InternalErrorCodes::INVALID_ARGUMENT:
                return Response::HTTP_BAD_REQUEST;
            case InternalErrorCodes::INTERNAL_SERVER_DRAMA:
            default:
                return Response::HTTP_INTERNAL_SERVER_ERROR;
        }
    }
}
