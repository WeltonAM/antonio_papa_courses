<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        return User::get([
            'first_name',
            'last_name',
            'email',
        ]);
    }

    public function show(User $user)
    {
        return User::find($user->id);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
        ], Response::HTTP_CREATED);
    }

    public function update(User $user, Request $request)
    {
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
        ], Response::HTTP_ACCEPTED);
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
