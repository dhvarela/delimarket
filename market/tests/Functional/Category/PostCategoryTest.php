<?php

namespace App\Tests\Functional\Category;

use App\Market\Category\Domain\CategoryRepository;
use App\UI\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PostCategoryTest extends WebTestCase
{
    private $client;
    private $repository;

    public function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::$container->get(CategoryRepository::class);
    }

    public function test_should_get_a_201(): void
    {
        $this->client->request(
            'POST',
            '/category',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json'
            ],
            '
            {
                "name": "ducks"
            }
            '
        );

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());

        $category = $this->repository->searchByName('ducks');

        $this->assertInstanceOf(Category::class, $category);
    }
}