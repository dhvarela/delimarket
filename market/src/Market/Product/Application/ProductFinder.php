<?php

namespace App\Market\Product\Application;

use App\Market\Product\Domain\ProductName;
use App\Market\Product\Domain\ProductNotFound;
use App\Market\Product\Domain\ProductRepository;

class ProductFinder
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function byFreeName(ProductName $name): array
    {
        $products = $this->repository->searchByFreeName($name);
        $this->ensureProducts($products);

        return $products;
    }

    private function ensureProducts(?array $products): void
    {
        if (!$products) {
            ProductNotFound::throw();
        }
    }
}