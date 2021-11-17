<?php

namespace App\Market\Category\Application;

use App\Market\Category\Domain\CategoryName;

class CategoryCreateRequest
{
    private $name;

    public function __construct(CategoryName $name)
    {
        $this->name = $name;
    }

    public function getName(): CategoryName
    {
        return $this->name;
    }
}