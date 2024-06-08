<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService) {}

    public function list() {
        $products = $this->productService->getProductList();
        rsort($products);
        return view('products.list', ['products' => $products]);
    }

    public function save(Request $request)
    {
        $this->productService->addProduct($request);

        return redirect()->route('products.add')->with('status', 'product-saved');
    }
}
