<?php

namespace App\Http\Controllers\Api;

use App\Ctx\CreateOrderContext;
use App\Ctx\UpdateOrderContext;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Repositories\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        protected readonly OrderRepositoryInterface $orderRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json(
            $this->orderRepository->paginate()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrderRequest $request)
    {
        $ctx = CreateOrderContext::fromArray($request->validated());

        try {
            return response()->json(
                $this->orderRepository->createOrder($ctx)
            );
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, string $id)
    {
        $ctx = UpdateOrderContext::fromArray([
            'id' => $id,
            ...$request->validated(),
        ]);

        try {
            return response()->json(
                $this->orderRepository->updateOrder($ctx)
            );
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
