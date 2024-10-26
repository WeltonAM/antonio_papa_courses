<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChartResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function chart()
    {
        Gate::authorize('view', 'orders');

        $orders = Order::query()
            ->join('orders_items', 'orders.id', '=', 'orders_items.order_id')
            ->selectRaw(
                'DATE_FORMAT(orders.created_at, "%Y-%m-%d") as date,
                    SUM(order_items.quantity * order_items.price) as sum
                '
            )
            ->groupBy('created_at')
            ->get();

        return ChartResource::collection($orders);
    }
}
