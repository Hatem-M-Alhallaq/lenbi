<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if (ControllersService::checkPermission('index-admin', 'admin')) {
        $page_title = 'Admins';
        $page_description = '';

        $admins = Admin::with('user')->simplePaginate(10);
        return response()->view('dashboard.admins.index', compact('admins', 'page_title', 'page_description'));
        } else {
            return response()->view('dashboard.error-6');
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


        if (ControllersService::checkPermission('Create-admin', 'admin')) {


        $roles = Role::where('guard_name', 'admin')->get();
        return response()->view('dashboard.admins.create',compact('roles'));
        }else{
            return response()->view('dashboard.error-6');

            
        }

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
            'role_id' => 'required|numeric|exists:roles,id',
            'username' => 'required|string|min:3|max:35',
            'email' => 'required|email|unique:admins,email',
            'image' => 'required|image|max:2048|mimes:png,jpg,jpeg',
        ]);

        if (!$validator->fails()) {
            $admin = new Admin();
            $admin->email = $request->get('email');
            $admin->password = Hash::make($request->get('password'));
            $admin->username = $request->get('username');

            $image = $request->file('image');
            $imageName = time() . '_Admin.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $imageName, ['disk' => 'public']);
            $admin->image = $imageName;
            $isSaved = $admin->save();
            if ($isSaved) {
                $role = Role::findById($request->get('role_id'));
                $admin->assignRole($role->id);
                $isSaved = $admin->save();
                return ['redirect' => route('admins.index')];
                return response()->json(['icon' => 'success', 'title' => 'admin created successfully'], $isSaved ? 201 : 400);
            } else {
                return response()->json(['message' => "Failed to save"], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
        return response()->view('dashboard.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
        $validator = Validator($request->all(), [
 
            'first_name' => 'required|string|min:3|max:35',
            'last_name' => 'required|string|min:3|max:35',
            'mobile' => 'required|numeric',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:1|in:M,F',
            'image' => 'required|image|max:2048|mimes:png,jpg,jpeg',
        ]);

        if (!$validator->fails()) {
            $admin->email = $request->get('email');
            $admin->password = Hash::make("password");
            $admin->username = $request->get('username');

            $image = $request->file('image');
            $imageName = time() . '_Admin.' . $image->getClientOriginalExtension();
            // $image->move(public_path('images'),$imageName); The First method to upload image in database
            $image->storeAs('images', $imageName, ['disk' => 'public']);
            $admin->image = $imageName;

            $isSaved = $admin->save();
            if ($isSaved) {
                 return ['redirect' => route('admins.index')];

                 return response()->json(['icon' => 'success', 'title' => 'admin updated successfully'], $isSaved ? 201 : 400);
            } else {
                return response()->json(['message' => "Failed to save"], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
        $admin->user()->delete();
        $isDeleted = $admin->delete();
        return response()->json(['icon' => 'success', 'title' => 'role deleted successfully'], $isDeleted ? 200 : 400);
    }

    public function showResetPasswordView($id)
    {
        return view('dashboard.admins.reset_password', compact('id'));
    }
    public function resetPassword(Request $request)
    {

        $request->validate([
            'new_password' => 'required|string',
            'new_password_confirmation' => 'required|string|same:new_password'
        ], ['current_password.password' => 'Your current password is not correct']);
        $user = Admin::find(Auth::user()->id);
        $user->password = Hash::make($request->get('new_password'));
        $isSaved = $user->save();
        if ($isSaved) {
            return ['redirect' => route('admins.index')];
            return response()->json(['icon' => 'success', 'title' => 'Password changed successfully'], 200);
        } else {
            return response()->json(['icon' => 'success', 'title' => 'Password change failed!'], 400);
        }
    }
}
