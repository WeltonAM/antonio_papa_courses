<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        Gate::allows('view', 'users');

        $users = User::paginate();

        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        Gate::allows('view', 'users');

        $user = User::find($user->id);

        return new UserResource($user);
    }

    public function store(UserCreateRequest $request)
    {
        Gate::allows('edit', 'users');

        $user = User::create($request->only('first_name', 'last_name', 'email', 'role_id') + [
            'password' => Hash::make($request->input('password')),
        ]);

        return response(new UserResource($user), Response::HTTP_CREATED);
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        Gate::allows('edit', 'users');

        $user->update($request->only([
            'first_name',
            'last_name',
            'email',
            'role_id',
        ]));

        return response(new UserResource($user), Response::HTTP_ACCEPTED);
    }

    public function destroy(User $user)
    {
        Gate::allows('edit', 'users');

        User::destroy($user->id);

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function user()
    {
        $user = Auth::user();
        return (new UserResource($user))->additional([
            'data' => [
                'permissions' => $user->permissions,
            ]
        ]);
    }

    public function updateInfo(UpdateInfoRequest $request)
    {
        $user = Auth::user();

        $user->update($request->only([
            'first_name',
            'last_name',
            'email',
        ]));

        return response(new UserResource($user), Response::HTTP_ACCEPTED);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        $user->update($request->only([
            'password' => Hash::make($request->input('password')),
        ]));

        return response(new UserResource($user), Response::HTTP_ACCEPTED);
    }
}
