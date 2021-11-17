<?php

namespace App\UI\Controller;

use App\Market\Category\Application\CategoryCreateRequest;
use App\Market\Category\Domain\CategoryName;
use App\Market\Product\Application\ProductFinder;
use App\Market\Product\Application\ProductGetResponse;
use App\Market\Product\Domain\ProductName;
use App\Market\Shared\Infrastructure\Response\ApiHttpCreatedResponse;
use App\Market\Shared\Infrastructure\Response\ApiHttpOkResponse;
use App\UI\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductGetController extends AbstractController
{
    /**
     * @Route("/product", name="product_get", methods={"GET"})
     */
    public function index(ProductFinder $finder, Request $request): Response
    {
        $name = $request->get('name');
        $products = $finder->byFreeName(
            new ProductName($name)
        );

        $pp = [];
        /** @var Product $p */
        foreach ($products as $p) {
            $pp[] = new ProductGetResponse(
                $p->getId(),
                $p->getName(),
                $p->getDescription(),
                $p->getAmount(),
                $p->getCurrency(),
                $p->getCategoryName()
            );
        }

        $response = new ApiHttpOkResponse($pp);

        return new JsonResponse($response->data(), $response->statusCode(), $response->headers());
    }
}
