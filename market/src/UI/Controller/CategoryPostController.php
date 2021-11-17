<?php

namespace App\UI\Controller;

use App\Market\Category\Application\CategoryCreateRequest;
use App\Market\Category\Application\CategoryCreator;
use App\Market\Category\Domain\CategoryName;
use App\Market\Shared\Infrastructure\Response\ApiHttpCreatedResponse;
use App\Market\Shared\Infrastructure\Service\EnsureBodyRequestIsAValidJson;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryPostController extends AbstractController
{
    /**
     * @Route("/category", name="category_post", methods={"POST"})
     */
    public function index(CategoryCreator $creator, EnsureBodyRequestIsAValidJson $ensureBodyRequestIsAValidJson): Response
    {
        $body = $ensureBodyRequestIsAValidJson->execute();

        $creator->execute(
            new CategoryCreateRequest(
                new CategoryName($body->name)
            )
        );

        $response = new ApiHttpCreatedResponse();

        return new JsonResponse($response->data(), $response->statusCode(), $response->headers());
    }
}
