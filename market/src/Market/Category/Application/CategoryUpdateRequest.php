<?php

namespace App\Market\Category\Application;

use App\Market\Category\Domain\CategoryId;
use App\Market\Category\Domain\CategoryName;

class CategoryUpdateRequest
{
    private $id;
    private $name;

    public function __construct(CategoryId $id, CategoryName $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }

    public function getId(): CategoryId
    {
        return $this->id;
    }

    public function getName(): CategoryName
    {
        return $this->name;
    }
}