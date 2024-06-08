<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartService
{
    public function getCart()
    {
        if (isset($_COOKIE['carts']))
        {
            return $_COOKIE['carts'] === NULL ? "[]" : $_COOKIE['carts'];            
        }
        
        return "[]";
    }

    public function addProductToCart($product)
    {
        $cartCookie = json_decode(
            request()->cookie('carts') === NULL ? "[]" : request()->cookie('carts'),
            TRUE
        );

        $check = array_filter($cartCookie, function ($cartCookie) use ($product) {
            return $cartCookie['id'] === $product['id'];            
        });

        if (count($check) > 0)
        {
            return [];
        }

        array_push($cartCookie, $product);

        return $cartCookie;
    }

    public function removeProductFromCart($productId)
    {
        $carts = json_decode($_COOKIE['carts'], TRUE);
        $filtered = array_filter($carts, function ($c) use ($productId) {
            return $c['id'] === $productId;
        });

        $deletedKeys = array_keys($filtered);

        unset($carts[$deletedKeys[0]]);

        return $carts;
    }
}
