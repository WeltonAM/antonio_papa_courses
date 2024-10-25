<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index(User $user)
    {
        return Link::where('user_id', $user->id)->get();
    }
}
