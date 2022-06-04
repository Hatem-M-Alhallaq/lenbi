<?php

namespace App\Http\Controllers;

use App\Models\clink;
use App\Models\hour;
use App\Models\Member;
use App\Models\memberMedicine;
use App\Models\model_has_role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Gd\Encoder;
use Spatie\Permission\Models\Role;

class clinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index()
    {

        // if (ControllersService::checkPermission('index-clink', 'admin')) {


        $page_title = 'clinks';
        $page_description = '';


        // if (ControllersService::checkPermission('index-clink', 'admin')) {\
        if (Auth::guard('admin')->check()) {
            $clinks = clink::simplePaginate(10);
            return response()->view('dashboard.clink.index', compact('clinks', 'page_title', 'page_description'));
        } else {
            $clink = clink::find(Auth::user()->id);
            if ($clink->model == 'admin') {
            $clinks = clink::where('sub_clink_id', Auth::user()->id)->simplePaginate(10);
            }elseif ($clink->model == 'clink'){
        $clinks = clink::where('id', Auth::user()->id)->where('model', 'clink')->simplePaginate(10);

            }
            return response()->view('dashboard.clink.index', compact('clinks'));
        }
        // } else {
        //     return response()->view('dashboard.error-6');
        // }
    }
     public function indexUser()
    {
        if (Auth::guard('admin')->check()) {
            $clinks = clink::where('model', 'user')->simplePaginate(5);

        }else{
        $clink = clink::find(Auth::user()->id);

        $clinks = clink::where('sub_clink_id', Auth::user()->sub_clink_id)->where('model', 'user')->simplePaginate(5);
        }
        return response()->view('dashboard.clink.indexUser', compact('clinks'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (ControllersService::checkPermission('Create-ckink', 'admin')) {

        $timestamp = strtotime('next Monday');
        for ($i = 0; $i < 7; $i++) {
            $days[] = strftime('%A', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }
        $roles = Role::where('guard_name', 'clink')->where('clink_id', Auth::user()->sub_clink_id)->get();
        $hoursRange = [];
        for ($i = 0; $i < 7; $i++) {
            $from = $i . '_from';
            $to = $i . '_to';

            array_push($hoursRange, $from);
            array_push($hoursRange, $to);
        }

        $hours = new hour();

        return view('dashboard.clink.create', compact('roles', 'days'));
        // } else {
        //     return response()->view('dashboard.error-6');
        // }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator($request->all(), [
            'role_id' => 'required|numeric|exists:roles,id',
            'address' => 'required|string|min:3|max:35',
            'username' => 'required|string',
            'email' => 'required|email|unique:clinks,email',
            'password' => 'required|string|min:6|max:35',
            'mobile' => 'required|numeric',
            // 'expiry_of_subscription' => 'required|date',
            'rhythm_of_visit' => 'required|numeric',

        ]);

        if (Auth::guard('admin')->user()) {
            if ($request->get('expiry_of_subscription') == null)
                return response()->json(['message' => "add rhythm of visit"], 400);
        }
        if (!$validator->fails()) {
            $clink = new clink();
            if (Auth::guard('clink')->check()) {

                $clinks = clink::find(Auth::user()->id);

                $clink->expiry_of_subscription = $clinks->expiry_of_subscription;
            }
            if (Auth::guard('admin')->user()) {
                $clink->expiry_of_subscription = $request->get('expiry_of_subscription');
            }
            $clink->rhythm_of_visit = $request->get('rhythm_of_visit');
            $clink->address = $request->get('address');
            $clink->username = $request->get('username');
            $clink->email = $request->get('email');
            $clink->password = Hash::make($request->get('password'));
            $clink->mobile = $request->get('mobile');
            $clink->save();
            if (Auth::guard('clink')->user()) {
                $clink->sub_clink_id = Auth::user()->sub_clink_id;
                $clink->created_by = Auth::user()->Username;
                $clink->model = 'clink';
                $isSaved = $clink->save();
            }

            if (Auth::guard('admin')->user()) {
                $clink->save();
                $clink->sub_clink_id = $clink->id;

                $clink->created_by = Auth::user()->username;
                $clink->model = 'admin';
                $isSaved = $clink->save();
            }
            $isSaved = $clink->save();
            if ($isSaved) {
                $role = Role::find($request->get('role_id'));
                $clink->assignRole($role->id);
                $workingHours = $this->workingHours($request, $clink);
                return ['redirect' => route('clinks.index')];
                return response()->json(['icon' => 'success', 'title' => 'clink created successfully'], $isSaved ? 201 : 400);
            } else {
                return response()->json(['message' => "Failed to save"], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }
    private function workingHours(Request $request, $clink)
    {


        $hours = new hour();
        $hours->clink_id = $clink->id;
        $hours->{'0_from'} = $request->{'0_from'} ?? null;
        $hours->{'0_to'} = $request->{'0_to'} ?? null;
        $hours->{'1_from'} = $request->{'1_from'} ?? null;
        $hours->{'1_to'} = $request->{'1_to'} ?? null;
        $hours->{'2_from'} = $request->{'2_from'} ?? null;
        $hours->{'2_to'} = $request->{'2_to'} ?? null;
        $hours->{'3_from'} = $request->{'3_from'} ?? null;
        $hours->{'3_to'} = $request->{'3_to'} ?? null;
        $hours->{'4_from'} = $request->{'4_from'} ?? null;
        $hours->{'4_to'} = $request->{'4_to'} ?? null;
        $hours->{'5_from'} = $request->{'5_from'} ?? null;
        $hours->{'5_to'} = $request->{'5_to'} ?? null;
        $hours->{'6_from'} = $request->{'6_from'} ?? null;
        $hours->{'6_to'} = $request->{'6_to'} ?? null;
        return  $hours->save();
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
        $clinks = clink::find($id);
        $roles = Role::where('guard_name', 'clink')->where('clink_id',Auth::user()->sub_clink_id)->get();
        $roleModel =  model_has_role::where('model_id', $id)->where('model_type', 'App\Models\clink')->first();

        $timestamp = strtotime('next Monday');
        for ($i = 0; $i < 7; $i++) {
            $days[] = strftime('%A', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }

        //Generate days columns
        $hoursRange = [];
        for ($i = 0; $i < 7; $i++) {
            $from = $i . '_from';
            $to = $i . '_to';

            array_push($hoursRange, $from);
            array_push($hoursRange, $to);
        }

        $hours = hour::where(['clink_id' => $id])->get($hoursRange)->first();
        return view('dashboard.clink.edit', compact('roles', 'hours', 'clinks', 'days','roleModel'));
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
         $validator = Validator($request->all(), [
            'role_id' => 'numeric|exists:roles,id',
            'address' => 'string|min:3|max:35',
            'username' => 'string',
            'mobile' => 'numeric',
            // 'expiry_of_subscription' => 'date',
            'rhythm_of_visit' => 'numeric',
        ]);

        if (!$validator->fails()) {

            $clink = clink::find($id);
            if($clink->model == 'user'){
             $clink->address = $clink->address;

            }else{
     $clink->address = $request->get('address');

            }
            $clink->username = $request->get('username');
            $clink->email = $request->get('email');
            $clink->mobile = $request->get('mobile');
            if (Auth::guard('clink')->check()) {

                $clinks = clink::find(Auth::user()->id);
                $clink->expiry_of_subscription = $clinks->expiry_of_subscription;
            }
            if (Auth::guard('admin')->user()) {
                $clink->expiry_of_subscription = $request->get('expiry_of_subscription');
            }
            $clink->rhythm_of_visit = $request->get('rhythm_of_visit');
            if (Auth::guard('admin')->user()) {
                $clink->sub_clink_id = $id;
            } elseif (Auth::guard('clink')->user()) {
                $clink->sub_clink_id = $id;
            }
            if (Auth::guard('admin')->user()) {
            $clinks = clink::where('sub_clink_id',$id)->get();
            foreach($clinks as $one_clink ){
             $one_clink->expiry_of_subscription = $request->get('expiry_of_subscription');
             $one_clink->save();
            }
        }
            $isSaved = $clink->save();
            if ($isSaved) {
                 if(Auth::guard('clink')->check()){
                if($id != auth('clink')->user()->id){
                $role = Role::find($request->get('role_id'));
                $roleModel =  model_has_role::where('model_id', $id)->where('model_type', 'App\Models\clink')->first();
                $clink->removeRole($roleModel->role_id);
                $clink->assignRole($role->id);
                }
                }elseif(Auth::guard('admin')->check()){
                $role = Role::find($request->get('role_id'));
                $roleModel =  model_has_role::where('model_id', $id)->where('model_type', 'App\Models\clink')->first();
                $clink->removeRole($roleModel->role_id);
                $clink->assignRole($role->id);
                }

                if($clink->model != 'user'){
                $workingHours = $this->updateworkingHours($request, $clink, $id);
                }
                $request->session()->flash('status', 'alert-success');
                $request->session()->flash('message', 'clink updated successfully');
                return redirect()->route('clinks.index');
            } else {
                $request->session()->flash('status', 'alert-danger');
                $request->session()->flash('message', $validator->getMessageBag()->first());
            }
        }
        return redirect()->back();
    }
    private function updateworkingHours(Request $request, $clink, $id)
    {
        $hours = hour::where('clink_id', $id)->first();

        $hours->{'0_from'} = $request->{'0_from'} ?? null;
        $hours->{'0_to'} = $request->{'0_to'} ?? null;
        $hours->{'1_from'} = $request->{'1_from'} ?? null;
        $hours->{'1_to'} = $request->{'1_to'} ?? null;
        $hours->{'2_from'} = $request->{'2_from'} ?? null;
        $hours->{'2_to'} = $request->{'2_to'} ?? null;
        $hours->{'3_from'} = $request->{'3_from'} ?? null;
        $hours->{'3_to'} = $request->{'3_to'} ?? null;
        $hours->{'4_from'} = $request->{'4_from'} ?? null;
        $hours->{'4_to'} = $request->{'4_to'} ?? null;
        $hours->{'5_from'} = $request->{'5_from'} ?? null;
        $hours->{'5_to'} = $request->{'5_to'} ?? null;
        $hours->{'6_from'} = $request->{'6_from'} ?? null;
        $hours->{'6_to'} = $request->{'6_to'} ?? null;
        return  $hours->save();
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

    public function showResetPasswordView($id)
    {
        return view('dashboard.clink.reset_password', compact('id'));
    }
    public function resetPassword(Request $request)
    {

        $request->validate([
            'new_password' => 'required|string',
            'new_password_confirmation' => 'required|string|same:new_password'
        ], ['current_password.password' => 'Your current password is not correct']);
        $user = clink::find($request->get('clink_id'));
        $user->password = Hash::make($request->get('new_password'));
        $isSaved = $user->save();
        if ($isSaved) {
            return ['redirect' => route('clinks.index')];
            return response()->json(['icon' => 'success', 'title' => 'Password changed successfully'], 200);
        } else {
            return response()->json(['icon' => 'success', 'title' => 'Password change failed!'], 400);
        }
    }

    public function clink(Request $request)
    {
          $clink = clink::where('model','admin')->get();
          if(Auth::guard('admin')->check()){
        $roles = Role::where('guard_name', 'clink')->get();
        }elseif(Auth::guard('clink')->check()){
            $roles = Role::where('guard_name', 'clink')->where('clink_id', Auth::user()->sub_clink_id)->get();

        }
        return view('dashboard.clink.user', compact('roles', 'clink'));
    }

    public function user(Request $request)
    {

        $validator = Validator($request->all(), [
            'email' => 'required|email|unique:clinks,email',
            'password' => 'required|string|min:6|max:35',
            'username' => 'required|string|min:3|max:35',
        ]);
        $clinks = new clink();
        $clinks->email = $request->get('email');
        $clinks->username = $request->get('username');
        $clinks->password = Hash::make($request->get('password'));
        $clinks->sub_clink_id = Auth::user()->sub_clink_id;
        if(Auth::guard('clink')->check()){
        $clink = clink::find(Auth::user()->sub_clink_id);
        } elseif (Auth::guard('admin')->check()) {

            $clinks->sub_clink_id = $request->get('clink_id');
            $clink = clink::find($request->get('clink_id'));
        }
        $clinks->expiry_of_subscription = $clink->expiry_of_subscription;
        $clinks->rhythm_of_visit = $clink->rhythm_of_visit;
        $clinks->address = $clink->address;
        $clinks->mobile = $clink->mobile;

        $clinks->model ='user';
        if (Auth::guard('clink')->user()) {
        $clinks->created_by = Auth::user()->Username;
        }
         if (Auth::guard('admin')->user()) {
        $clinks->created_by = Auth::user()->username;
        }
        $isSaved = $clinks->save();
        if ($isSaved) {

            $role = Role::find($request->get('role_id'));
            $clinks->assignRole($role->id);
            return ['redirect' => route('clinks.index')];
            return response()->json(['icon' => 'success', 'title' => 'clink created successfully'], $isSaved ? 201 : 400);
        } else {
            return response()->json(['message' => "Failed to save"], 400);
        }
    }
}
