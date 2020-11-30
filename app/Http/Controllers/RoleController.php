<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        return response()->json(Role::all(), 200);
    }

    public function store(Request $request)
    {
        $role = Role::create([
            'name'  => $request->name
        ]);
        $role->givePermissionTo($request->permission);
        
        return response()->json([
            'message'   => $role ? 'Success Created User Role' : 'Error Creating User Role'
        ]);
    }

    public function addPermission(Request $request)
    {
        $role = Role::findByName();
        $role->givePermissionTo($request->permission);

        return response()->json([
            'status'    => (bool)$role,
            'message'   => $role ? 'Success Added Permission' : 'Error Add Permission'
        ]);
    }

    public function update()
    {
        //
    }

    public function delete()
    {
        //
    }
}
