<?php

namespace App\UI\Controller;

use App\Market\Category\Application\CategoryUpdater;
use App\Market\Category\Application\CategoryUpdateRequest;
use App\Market\Category\Domain\CategoryId;
use App\Market\Category\Domain\CategoryName;
use App\Market\Shared\Infrastructure\Response\ApiHttpNoContentResponse;
use App\Market\Shared\Infrastructure\Service\EnsureBodyRequestIsAValidJson;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryPutController extends AbstractController
{
    /**
     * @Route("/category", name="category_put", methods={"PUT"})
     */
    public function index(CategoryUpdater $updater, EnsureBodyRequestIsAValidJson $ensureBodyRequestIsAValidJson): Response
    {
        $body = $ensureBodyRequestIsAValidJson->execute();

        $updater->execute(
            new CategoryUpdateRequest(
                new CategoryId($body->id),
                new CategoryName($body->name)
            )
        );

        $response = new ApiHttpNoContentResponse();

        return new JsonResponse($response->data(), $response->statusCode(), $response->headers());
    }
}
