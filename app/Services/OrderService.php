<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Order;

class OrderService
{
    public function getOrderList()
    {

    }

    public function makeOrder()
    {
        $carts = json_decode($_COOKIE['carts'], true);
        $total_items = count($carts);
        $amount = array_sum(array_column($carts, 'price'));
        
        $order = new Order;
        $order->user_id = auth()->user()->id;
        $order->total_items = $total_items;
        $order->amount = $amount;
        $order->save();

        setcookie('carts', json_encode([]), 60);

        return $order->id;
    }
}
