<?php

namespace App\Market\Category\Application;

use App\Market\Category\Domain\Category;
use App\Market\Category\Domain\CategoryRepository;

class CategoryCreator
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CategoryCreateRequest $createRequest): void
    {
        $category = Category::create(
            $createRequest->getName()
        );
        $this->repository->save($category);
    }
}