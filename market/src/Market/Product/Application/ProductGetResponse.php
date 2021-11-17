<?php

namespace App\Market\Product\Application;

final class ProductGetResponse implements \JsonSerializable
{
    private $id;
    private $name;
    private $description;
    private $amount;
    private $currency;
    private $category;

    public function __construct(int $id, string $name, string $description, float $amount, string $currency, string $category)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->category = $category;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}