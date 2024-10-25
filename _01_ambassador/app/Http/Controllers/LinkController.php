<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\LinkProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Str;
use Symfony\Component\HttpFoundation\Response;

class LinkController extends Controller
{
    public function index(User $user)
    {
        return Link::where('user_id', $user->id)->get();
    }

    public function store(Request $request, User $user)
    {
        $link = Link::create([
            'user_id' => $request->user()->id,
            'code' => Str::random(6),
        ]);

        foreach($request->input('product_ids', []) as $product_id) {
            LinkProduct::create([
                'link_id' => $link->id,
                'product_id' => $product_id,
            ]);
        }

        return response($link, Response::HTTP_CREATED);
    }
}
