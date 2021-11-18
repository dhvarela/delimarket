<?php

namespace App\Tests\Unit\Category\Application;

use App\Market\Category\Application\CategoryCreateRequest;
use App\Market\Category\Application\CategoryCreator;
use App\Market\Category\Domain\Category;
use App\Market\Category\Domain\CategoryName;
use App\Market\Category\Domain\CategoryRepository;
use Faker\Factory;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class CategoryCreatorTest extends MockeryTestCase
{
    private $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
    }

    public function test_should_create_a_category(): void
    {
        $name = $this->faker->text(100);

        $request = new CategoryCreateRequest(
            new CategoryName($name)
        );

        $categoryRepository = Mockery::mock(CategoryRepository::class);
        $categoryRepository->shouldReceive('save')
            ->once()
            ->with(Category::class)
            ->andReturnNull();

        $creator = new CategoryCreator($categoryRepository);
        $creator->execute($request);
    }

}
