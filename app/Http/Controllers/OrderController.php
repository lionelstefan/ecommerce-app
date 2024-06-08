<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Models\Order;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService) {}

    public function list()
    {
        $orders = Order::all();

        return view('order.list', ['orders' => $orders]);
    }

    public function make()
    {
        $this->orderService->makeOrder();
        return redirect()->route('orders')->with('status', 'order-created');
    }
}
