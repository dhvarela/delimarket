<?php

namespace App\Tests\Functional\Product;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GetCategoryTest extends WebTestCase
{
    private $client;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function test_should_get_a_404(): void
    {
        $this->client->request('GET', '/product?name=asdfsadf');

        $this->assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
    }

    public function test_should_get_a_200(): void
    {
        $this->client->request('GET', '/product?name=cat');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
}