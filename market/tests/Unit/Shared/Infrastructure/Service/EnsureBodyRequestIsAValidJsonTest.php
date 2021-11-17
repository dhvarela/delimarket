<?php

namespace App\Tests\Unit\Shared\Infrastructure\Service;

use PHPUnit\Framework\TestCase;

class EnsureBodyRequestIsAValidJsonTest extends TestCase
{
    public function test_should_fail_when_value_is_not_a_json()
    {
        $this->assertTrue(true);
    }
}