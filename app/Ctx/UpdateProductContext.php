<?php

namespace App\Ctx;

final class UpdateProductContext
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $id,
        public readonly ?string $name,
        public readonly ?int $stock,
        public readonly ?int $price,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'] ?? null,
            stock: (int) $data['stock'] ?? null,
            price: (int) $data['price'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this?->name,
            'stock' => $this?->stock,
            'price' => $this?->price,
        ];
    }
}
