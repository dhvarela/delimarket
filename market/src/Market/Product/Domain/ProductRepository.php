<?php

namespace App\Market\Product\Domain;

use App\UI\Entity\Product;

interface ProductRepository
{
    public function search(int $id): ?Product;

    public function searchByFreeName(string $name): ?array;

    public function save(Product $product): void;
}
