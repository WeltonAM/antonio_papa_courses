<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\LinkProduct;
use App\Models\Product;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    public function run(): void
    {
        Link::factory(30)->create()->each(function (Link $link) {
            LinkProduct::create([
                'link_id' => $link->id,
                'product_id' => Product::inRandomOrder()->first()->id,
            ]);
        });
    }
}
