<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class clinkAuthController extends Controller
{
    //

    public function showLogin()
    {
        return response()->view('dashboard.auth.clinkLogin');
    }


    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|string',
            'password' => 'required|string|min:3',
            'remember_me' => 'required|boolean',
            // 'guard' => 'required|string|in:admin,clink'
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Please enter the correct e-mail',
            'password.required' => 'Password is required',
            // 'guard.in' => 'Enter the correct password'
        ]);

        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];
        if (!$validator->fails()) {

            if (Auth::guard('clink')->attempt($credentials, $request->get('remember_me'))) {
                $date = Carbon::today()->toDateString();
                $user = Auth::guard('clink')->user();
                if (Auth::guard('clink')->check()) {
                    if ($date > $user->expiry_of_subscription) {
                        return response()->json(['icon' => 'error', 'title' => 'you subscription end please contact the adminstratior'], 400);
                    }
                }
                return response()->json(['icon' => 'success', 'title' => 'Login Successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'Login Faild'], 400);
            }
        } else {

            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }


    public function logout(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('dashboard.login', 'admin');
    }

    public function editPassword()
    {
        return response()->view('dashboard.auth.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|confirmed',
            'new_password_confirmation' => 'required|string'
        ]);

        if (!$validator->fails()) {
            $admin = Admin::findOrFail(Auth()->guard('admin')->user()->id);
            $admin->password = Hash::make($request->get('new_password'));
            $isSaved = $admin->save();

            return response()->json(['icon' => 'success', 'title' => 'Password update successfully'], $isSaved ? 200 : 400);
        } else {
            return response()->json(['icon' => 'error', 'title' => 'Password update faild'], 400);
        }
    }



    public function editProfile()
    {

        return view('dashboard.auth.edit-profile');
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator($request->all(), [
            'first_name' => 'required|string|min:3|max:35',
            'last_name' => 'required|string|min:3|max:35',
            'mobile' => 'required|numeric',
            'email' => 'required|email|unique:admins,email,',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:1|in:M,F',
            'image' => 'required|image|max:2048|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {
            if (auth('admin')->check()) {
                $admin = auth('admin')->user();
            } else {
                $admin = auth('clink')->user();
            }
            $admin->email = $request->email;

            $image = $request->file('image');
            $imageName = time() . '_Admin.' . $image->getClientOriginalExtension();
            // $image->move(public_path('images'),$imageName); The First method to upload image in database
            $image->storeAs('images', $imageName, ['disk' => 'public']);
            $admin->image = $imageName;

            $isSaved = $admin->save();
            if ($isSaved) {
                $user = $admin->user;
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->mobile = $request->mobile;
                $user->birth_date = $request->birth_date;
                $user->gender = $request->gender;
                $isSaved = $user->save();
                return response()->json(
                    ['status' => true, 'message' => "Updated Successfully"],
                    200
                );
            }
        } else {
            return response()->json(
                ['status' => false, 'message' => $validator->getMessageBag()->first()],
                400
            );
        }
    }
}
