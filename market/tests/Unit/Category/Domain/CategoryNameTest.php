<?php

namespace App\Tests\Unit\Category\Domain;

use App\Market\Category\Application\CategoryCreateRequest;
use App\Market\Category\Domain\CategoryName;
use App\Market\Shared\Domain\Exception\DomainInvalidArgument;
use PHPUnit\Framework\TestCase;

class CategoryNameTest extends TestCase
{
    public function test_should_fail_creating_a_short_category_name(): void
    {
        $name = "aa";

        $this->expectException(DomainInvalidArgument::class);

        $request = new CategoryCreateRequest(
            new CategoryName($name)
        );
    }

    public function test_should_fail_creating_a_long_category_name(): void
    {
        $name = "longString longString longString longString longString longString longString longString longString longString longString ";

        $this->expectException(DomainInvalidArgument::class);
        $this->expectExceptionMessage("The category name length can't be greater than 100");

        $request = new CategoryCreateRequest(
            new CategoryName($name)
        );
    }

}
