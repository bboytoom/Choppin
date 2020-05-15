<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;
use App\Repositories\ProductRepository;
use App\Models\Product;

class ProductController extends Controller
{
    protected $prod;
    private $pages = 10;

    public function __construct(ProductRepository $prod)
    {
        $this->authorizeResource(Product::class, 'product');
        $this->prod = $prod;
    }

    public function index()
    {
        $products = Product::whereHas('subcategory', function ($productsEstatus) {
            $productsEstatus->where('status', 1);
        })->paginate($this->pages);

        return new ProductCollection($products);
    }

    public function store(ProductRequest $request)
    {
        return response(null, $this->prod->createProduct($request));
    }

    public function show(Product $product)
    {
        ProductResource::withoutWrapping();
        return new ProductResource($product);
    }

    public function update(ProductRequest $request, Product $product)
    {
        return response(null, $this->prod->updateProduct($request, $product));
    }

    public function destroy(Product $product)
    {
        return response(null, $this->prod->deleteProduct($product));
    }
}
