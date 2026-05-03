<?php

namespace App\Ctx;

final class CreateProductContext
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $name,
        public readonly int $stock,
        public readonly int $price,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            stock: (int) $data['stock'],
            price: (int) $data['price']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'stock' => $this->stock,
            'price' => $this->price,
        ];
    }
}
