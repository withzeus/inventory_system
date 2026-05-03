<?php

namespace App\Http\Controllers\Api;

use App\Ctx\CreateProductContext;
use App\Ctx\UpdateProductContext;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Repositories\ProductRepositoryInterface;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            $this->productRepository->paginate()
        );
    }

    public function select()
    {
        return response()->json(
            $this->productRepository->getAll()
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
    public function store(CreateProductRequest $request)
    {
        $ctx = CreateProductContext::fromArray($request->validated());

        return $this->productRepository->createProduct($ctx);
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
    public function update(UpdateProductRequest $request, string $id)
    {
        $ctx = UpdateProductContext::fromArray([
            'id' => $id,
            ...$request->validated(),
        ]);

        return $this->productRepository->updateProduct($ctx);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
