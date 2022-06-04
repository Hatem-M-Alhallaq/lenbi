<?php

namespace App\Http\Controllers;

use App\Models\model_has_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Role';
        $page_description = '';
        if (Auth::guard('admin')->user()) {
            $roles = Role::withCount('permissions')->get();
            return response()->view('dashboard.spatie.role.index', compact('roles', 'page_title', 'page_description'));
        } else {
          $roles = Role::Where('clink_id',Auth::user()->sub_clink_id)->withCount('permissions')->get();
          return response()->view('dashboard.spatie.role.index', compact('roles', 'page_title', 'page_description'));

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
      
        return response()->view('dashboard.spatie.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|max:100',
            'guard_name' => 'required|string|in:admin,clink',
        ]);

        if (!$validator->fails()) {
            $role = new Role();
            $role->name = $request->get('name');
            if(Auth::guard('admin')->user()){
             $role->guard_name = 'admin';
             $role->clink_id = Auth::user()->id;
            }
            if(Auth::guard('clink')->user()){
            $role->guard_name = 'clink';
            $role->clink_id = Auth::user()->sub_clink_id;
            }
            $isSaved = $role->save();
            return ['redirect' => route('roles.index')];
            return response()->json(['icon' => 'success', 'title' => 'role created successfully'], $isSaved ? 201 : 400);
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
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
         
        $role = Role::findById($id);
        return response()->view('dashboard.spatie.role.edit', compact('role'));
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
        $validator = Validator($request->all(), [
            'name' => 'required|string|max:100',
            'guard_name' => 'required|string|in:admin',
        ]);

        if (!$validator->fails()) {
            $role = Role::findById($id);
            $role->name = $request->get('name');
            $role->guard_name = $request->get('guard_name');
            $isSaved = $role->save();
            return ['redirect' => route('roles.index')];
            return response()->json(['icon' => 'success', 'title' => 'role updated successfully'], $isSaved ? 200 : 400);
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
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
         $roleModel =  model_has_role::where('role_id', $id)->first();
        if(!empty($roleModel)){
        $isDeleted = Role::destroy($id);
        return back();
        }
    }
     public function delete($id)
    {
      
        $roleModel =  model_has_role::where('role_id', $id)->first();
         
        if($roleModel == null){
        $isDeleted = Role::find($id)->destroy($id);
        return back();
        }else{
            return back();
        }
    }
}
