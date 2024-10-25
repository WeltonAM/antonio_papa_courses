<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $links = Link::where('user_id', $user->id)->get();

        return $links->map(function (Link $link) {
            $orders = Order::where('code', $link->code)->get()->where('complete', 1);

            return [
                'code' => $link->code,
                'count' => $orders->count(),
                'revenue' => $orders->sum(fn (Order $order) => $order->ambassador_revenue),
            ];
        });
    }

    public function rankings()
    {
        $ambassadors = User::ambassadors()->get();

        $rankings = $ambassadors->map(fn (User $user) => [
            'name' => $user->name,
            'revenue' => $user->revenue,
        ]);

        return $rankings->sortByDesc('revenue')->values();
    }
}