<?php

namespace App\Ctx;

use Illuminate\Support\Facades\Auth;

final class UpdateOrderContext
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $id,
        public readonly string $user_id,
        public readonly int $total_price,
        public readonly array $items
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            user_id: Auth::id(),
            total_price: (int) $data['total_price'],
            items: $data['items']
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'total_price' => $this->total_price,
            'items' => $this->items,
        ];
    }
}
