<?php

namespace App\Tests\Unit\Category\Application;

use App\Market\Category\Application\CategoryFinder;
use App\Market\Category\Application\CategoryUpdater;
use App\Market\Category\Application\CategoryUpdateRequest;
use App\Market\Category\Domain\Category;
use App\Market\Category\Domain\CategoryId;
use App\Market\Category\Domain\CategoryName;
use App\Market\Category\Domain\CategoryRepository;
use Faker\Factory;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class CategoryUpdaterTest extends MockeryTestCase
{
    private $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
    }

    public function test_should_update_a_category(): void
    {
        $categoryMock = Mockery::mock(Category::class);
        $categoryMock->shouldReceive('rename')
            ->once()
            ->with(CategoryName::class)
            ->andReturnNull();

        $name = $this->faker->text(100);
        $request = new CategoryUpdateRequest(
            new CategoryId(1),
            new CategoryName($name)
        );

        $finder = Mockery::mock(CategoryFinder::class);
        $finder->shouldReceive('byId')
            ->once()
            ->with(CategoryId::class)
            ->andReturn($categoryMock);

        $categoryRepository = Mockery::mock(CategoryRepository::class);
        $categoryRepository->shouldReceive('save')
            ->once()
            ->with(Category::class)
            ->andReturnNull();

        $updater = new CategoryUpdater($finder, $categoryRepository);
        $updater->execute($request);
    }

}
