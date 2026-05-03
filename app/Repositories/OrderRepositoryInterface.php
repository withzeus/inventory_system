<?php

namespace App\Repositories;

use App\Ctx\CreateOrderContext;
use App\Ctx\UpdateOrderContext;

interface OrderRepositoryInterface
{
    public function getAll();

    public function paginate();

    public function getOrder(string $id);

    public function createOrder(CreateOrderContext $ctx);

    public function updateOrder(UpdateOrderContext $ctx);
}
