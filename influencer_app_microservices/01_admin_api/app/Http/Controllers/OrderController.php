<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::paginate();

        return OrderResource::collection($order);
    }

    public function show($id)
    {
        return new OrderResource(Order::find($id));
    }

    public function export()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="orders.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () {
            $orders = Order::all();
            $filr = fopen('php://output', 'w');

            fputcsv($filr, ['ID', 'Name', 'Email', 'Product Title', 'Price', 'Quantity']);

            foreach ($orders as $order) {
                foreach ($order->orderItems as $item) {
                    fputcsv($filr, [
                        $order->id,
                        $order->name,
                        $order->email,
                        $item->product_title,
                        $item->price,
                        $item->quantity,
                    ]);
                }
            }
        };

        return \Response::stream($callback, 200, $headers);
    }
}
