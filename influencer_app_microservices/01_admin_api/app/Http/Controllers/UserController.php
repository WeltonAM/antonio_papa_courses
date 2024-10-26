<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        return User::select('id', 'first_name', 'last_name', 'email')->paginate();
    }

    public function show(User $user)
    {
        return User::select('id', 'first_name', 'last_name', 'email')->find($user->id);
    }

    public function store(UserCreateRequest $request)
    {
        $user = User::create($request->only('first_name', 'last_name', 'email') + [
            'password' => Hash::make(123),
        ]);

        return response([
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
        ], Response::HTTP_CREATED);
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $user->update($request->only([
            'first_name',
            'last_name',
            'email',
        ]));

        return response([
            'id' => $user->id,
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

    public function user()
    {
        return Auth::user();
    }

    public function updateInfo(UpdateInfoRequest $request)
    {
        $user = Auth::user();

        $user->update($request->only([
            'first_name',
            'last_name',
            'email',
        ]));

        return response([
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
        ], Response::HTTP_ACCEPTED);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        $user->update($request->only([
            'password' => Hash::make($request->input('password')),
        ]));

        return response([
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
        ], Response::HTTP_ACCEPTED);
    }
}
