<?php

namespace App\Market\Category\Application;

use App\Market\Category\Domain\Category;
use App\Market\Category\Domain\CategoryId;
use App\Market\Category\Domain\CategoryNotFound;
use App\Market\Category\Domain\CategoryRepository;

class CategoryFinder
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function byId(CategoryId $id): Category
    {
        $category = $this->repository->search($id->value());
        $this->ensureCategory($category);

        return $category;
    }

    private function ensureCategory(?Category $category): void
    {
        if (!$category) {
            CategoryNotFound::throw();
        }
    }
}