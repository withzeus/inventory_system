<?php

namespace App\Repositories\E;

use App\Ctx\CreateProductContext;
use App\Ctx\UpdateProductContext;
use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use Override;

class ProductRepository implements ProductRepositoryInterface
{
    #[Override]
    public function getAll()
    {
        return Product::query()->latest()->get();
    }

    #[Override]
    public function paginate()
    {
        return Product::query()->latest()->paginate();
    }

    #[Override]
    public function getProduct(string $id)
    {
        return Product::findOrFail($id);
    }

    #[Override]
    public function createProduct(CreateProductContext $ctx)
    {
        return Product::create($ctx->toArray());
    }

    #[Override]
    public function updateProduct(UpdateProductContext $ctx)
    {
        $product = $this->getProduct($ctx->id);

        return $product->update($ctx->toArray());
    }
}
