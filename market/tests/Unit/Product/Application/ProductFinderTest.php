<?php

namespace App\Tests\Unit\Product\Application;

use App\Market\Product\Application\ProductFinder;
use App\Market\Product\Domain\Product;
use App\Market\Product\Domain\ProductName;
use App\Market\Product\Domain\ProductNotFound;
use App\Market\Product\Domain\ProductRepository;
use Faker\Factory;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class ProductFinderTest extends MockeryTestCase
{
    private $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
    }

    public function test_should_find_a_product(): void
    {
        $name = $this->faker->text(100);
        $productName = new ProductName($name);

        $productMock = Mockery::mock(Product::class);

        $productRepository = Mockery::mock(ProductRepository::class);
        $productRepository->shouldReceive('searchByFreeName')
            ->once()
            ->with($name)
            ->andReturn([$productMock]);

        $finder = new ProductFinder($productRepository);
        $finder->byFreeName($productName);
    }

    public function test_should_not_find_a_product(): void
    {
        $name = $this->faker->text(100);
        $productName = new ProductName($name);

        $this->expectException(ProductNotFound::class);

        $productRepository = Mockery::mock(ProductRepository::class);
        $productRepository->shouldReceive('searchByFreeName')
            ->once()
            ->with($name)
            ->andReturn([]);

        $finder = new ProductFinder($productRepository);
        $finder->byFreeName($productName);
    }

}
