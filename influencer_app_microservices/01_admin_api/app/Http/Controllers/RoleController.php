<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function index()
    {
        Gate::allows('view', 'roles');

        return RoleResource::collection(Role::all());
    }

    public function store(Request $request)
    {
        Gate::allows('view', 'roles');

        $role = Role::create($request->only('name'));

        if($permissions = $request->input('permissions')) {
            foreach ($permissions as $permission_id) {
                DB::table('role_permission')->insert([
                    'role_id' => $role->id,
                    'permission_id' => $permission_id,
                ]);
            }
        }

        return response(new RoleResource($role), Response::HTTP_CREATED);
    }

    public function show(string $id)
    {
        Gate::allows('edit', 'roles');

        return new RoleResource(Role::find($id));
    }

    public function update(Request $request, string $id)
    {
        Gate::allows('edit', 'roles');

        $role = Role::find($id);
        $role->update($request->only('name'));

        DB::table('role_permission')->where('role_id', $role->id)->delete();

        if($permissions = $request->input('permissions')) {
            foreach ($permissions as $permission_id) {
                DB::table('role_permission')->insert([
                    'role_id' => $role->id,
                    'permission_id' => $permission_id,
                ]);
            }
        }

        return response(new RoleResource($role), Response::HTTP_ACCEPTED);
    }

    public function destroy(string $id)
    {
        Gate::allows('edit', 'roles');

        DB::table('role_permission')->where('role_id', $id)->delete();

        Role::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
