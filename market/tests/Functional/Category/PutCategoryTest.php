<?php

namespace App\Tests\Functional\Category;

use App\Market\Category\Domain\Category;
use App\Market\Category\Domain\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PutCategoryTest extends WebTestCase
{
    private $client;
    private $repository;

    public function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::$container->get(CategoryRepository::class);
    }

    public function test_should_get_a_204(): void
    {
        $this->client->request(
            'PUT',
            '/category',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json'
            ],
            '
            {
                "id": 3,
                "name": "holidays NEW"
            }
            '
        );

        $this->assertEquals(Response::HTTP_NO_CONTENT, $this->client->getResponse()->getStatusCode());

        $category = $this->repository->searchByName('holidays NEW');

        $this->assertInstanceOf(Category::class, $category);
    }

    public function test_should_get_a_404(): void
    {
        $this->client->request(
            'PUT',
            '/category',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json'
            ],
            '
            {
                "id": 3000,
                "name": "holidays NEW"
            }
            '
        );

        $this->assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
    }
}