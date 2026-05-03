<?php

namespace App\Repositories;

use App\Ctx\CreateProductContext;
use App\Ctx\UpdateProductContext;

interface ProductRepositoryInterface
{
    public function getAll();

    public function paginate();

    public function getProduct(string $id);

    public function createProduct(CreateProductContext $ctx);

    public function updateProduct(UpdateProductContext $ctx);
}
