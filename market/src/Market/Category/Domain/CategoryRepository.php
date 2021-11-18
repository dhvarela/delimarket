<?php

namespace App\Market\Category\Domain;

interface CategoryRepository
{
    public function search(int $id): ?Category;

    public function searchByName(string $name): ?Category;

    public function save(Category $category): void;
}
