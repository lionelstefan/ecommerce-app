<?php

namespace App\Services;

use Illuminate\Http\Request;

class ProductService
{
    public function getProductList()
    {
        return session('products') === NULL ? [] : session('products');
    }

    public function addProduct($request)
    {
        $products = session('products') === NULL ? [] : session('products');
        $new = [];
        $new['id'] = 1;

        if (count($products) > 0)
        {
            $new['id'] = $products[array_key_last($products)]['id'] + 1;
        }

        $new['name'] = request()->all()['name'];
        $new['desc'] = request()->all()['desc'];
        $new['price'] = request()->all()['price'];
        
        session()->push('products', $new);

        return;
    }
}
