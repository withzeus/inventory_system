<?php

namespace App\Repositories\E;

use App\Ctx\CreateOrderContext;
use App\Ctx\UpdateOrderContext;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Repositories\OrderRepositoryInterface;
use Error;
use Illuminate\Support\Facades\DB;
use Override;

class OrderRepository implements OrderRepositoryInterface
{
    #[Override]
    public function getAll()
    {
        return Order::all();
    }

    #[Override]
    public function paginate()
    {
        return Order::with(['user', 'items'])->latest()->paginate();
    }

    #[Override]
    public function getOrder(string $id)
    {
        return Order::findOrFail($id);
    }

    #[Override]
    public function createOrder(CreateOrderContext $ctx)
    {
        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => $ctx->user_id,
                'total_price' => $ctx->total_price,
            ]);

            foreach ($ctx->items as $item) {

                $product = Product::where('id', $item['product_id'])->lockForUpdate()->first();

                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Not enough stock for {$product->name}");
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new Error('Failed to create order');
        }
    }

    #[Override]
    public function updateOrder(UpdateOrderContext $ctx)
    {
        DB::beginTransaction();

        try {
            $order = Order::with('items')->findOrFail($ctx->id);
            foreach ($order->items as $oldItem) {
                Product::where('id', $oldItem->product_id)
                    ->increment('stock', $oldItem->quantity);
            }

            OrderItem::where('order_id', $order->id)->delete();

            $total = 0;

            foreach ($ctx->items as $item) {

                $product = Product::where('id', $item['product_id'])
                    ->lockForUpdate()
                    ->first();

                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Not enough stock for {$product->name}");
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                ]);

                $product->decrement('stock', $item['quantity']);

                $total += $product->price * $item['quantity'];
            }

            $order->update([
                'total_price' => $total,
            ]);
            DB::commit();

        } catch (\Throwable $e) {
            DB::rollBack();
            throw new Error('Failed to create order');
        }
    }
}
