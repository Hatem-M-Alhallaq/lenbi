<?php

namespace App\Http\Controllers;

use App\Models\model_has_role;
use App\Models\role_has_permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index($roleId)
    {
        //
        if (Auth::guard('admin')->user()) {
            $permissions = Permission::all();
            $permissions = Permission::all();
           $role = Role::findOrFail($roleId);
             $rolePermissions = $role->permissions;
            if (count($rolePermissions) > 0) {
                foreach ($permissions as $permission) {
                    $permission->setAttribute('active', false);
                    foreach ($rolePermissions as $rolePermission) {
                        if ($rolePermission->id == $permission->id) {
                            $permission->active = true;
                        }
                    }
                }
            }
            if($role->guard_name == 'admin' ){
                return response()->view('dashboard.spatie.role.role_permission', ['roleId' => $roleId, 'permissions' => $permissions , 'role'=> $role]);

            }elseif($role->guard_name == 'clink' ){
                return response()->view('dashboard.spatie.role.role_permissionClink', ['roleId' => $roleId, 'permissions' =>$permissions, 'role' => $role]);
    
            }
        } elseif (Auth::guard('clink')->user()) {
             
        $role = model_has_role::where('model_id', Auth::user()->sub_clink_id)->get();
            
             $permission = role_has_permission::whereIn('role_id', $role->pluck('role_id'))->get();
            $permissions = Permission::where('guard_name', 'clink')->whereIn('id', $permission->pluck('permission_id'))->get();
            
            $rolePermissions = Role::findOrFail($roleId)->permissions;
            if (count($rolePermissions) > 0) {
                foreach ($permissions as $permission) {
                    $permission->setAttribute('active', false);
                    foreach ($rolePermissions as $rolePermission) {
                        if ($rolePermission->id == $permission->id) {
                            $permission->active = true;
                        }
                    }
                }
            }

            return response()->view('dashboard.spatie.role.role_permissionClinks', ['roleId' => $roleId, 'permissions' => $permissions]);

         }

    
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $roleId)
    {

        $validator = Validator($request->all(), [
            'permission_id' => 'required|exists:permissions,id',
        ]);
        if (!$validator->fails()) {
            $role = Role::findOrFail($roleId);
            $permission = Permission::findOrFail($request->get('permission_id'));

            if ($role->hasPermissionTo($permission->id)) {
                $role->revokePermissionTo($permission->id);

            } else {
                $role->givePermissionTo($permission->id);
            }
            return response()->json(['icon' => 'success', 'title' => 'Role permission status updated'], 200);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
