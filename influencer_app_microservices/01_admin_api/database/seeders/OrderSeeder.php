<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::factory()->count(30)->create()->each(function (Order $order) {
            OrderItem::factory()->count(5)->create([
                'order_id' => $order->id,
            ]);
        });
    }
}
