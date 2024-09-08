<?php

declare(strict_types=1);

namespace Architecture\Application;


class ProductInputDTO
{
    public function __construct(
        public ?string $name = null,
        public ?string $description = null,
        public ?float $price = null,
        public ?int $quantity = null,
        public bool $active = true
    )
    {}
}