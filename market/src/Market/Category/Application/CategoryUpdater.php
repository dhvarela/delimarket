<?php

namespace App\Market\Category\Application;

use App\Market\Category\Domain\CategoryRepository;

class CategoryUpdater
{
    private $repository;
    private $finder;

    public function __construct(CategoryFinder $finder, CategoryRepository $repository)
    {
        $this->repository = $repository;
        $this->finder     = $finder;
    }

    public function execute(CategoryUpdateRequest $updateRequest): void
    {
        $category = $this->finder->byId($updateRequest->getId());

        $category->rename($updateRequest->getName());

        $this->repository->save($category);
    }
}