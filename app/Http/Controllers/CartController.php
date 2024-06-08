<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Services\CartService;

class CartController extends Controller
{
    public function __construct(protected CartService $cartService) {}
    
    public function list()
    {
        $cart = $this->cartService->getCart();
        return view('cart.list', ['cart' => json_decode($cart, true)]);
    }

    public function add()
    {
        $cartCookie = $this->cartService->addProductToCart(request()->all()['product']);
        if (count($cartCookie) === 0)
        {
            return response()->json([
                'success' => false,
                'message' => 'Product already added !'
            ]);
        }

        return response()->json([
            'success' => true
        ])
        ->withCookie(
            Cookie::make('carts', json_encode($cartCookie), 60, null, null, false, false, false, null));
    }

    public function remove()
    {
        $cartCookie = $this->cartService->removeProductFromCart(request()->all()['productId']);
        return response()->json([
            'success' => true
        ])->withCookie(
            Cookie::make('carts', json_encode($cartCookie), 60, null, null, false, false, false, null));
    }
}
