<?php

namespace App\Http\Controllers;

use App\Models\clink;
use App\Models\Member;
use App\Models\memberMedicine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class memberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (ControllersService::checkPermission('index-member', 'admin')) {
            $page_title = 'members';
            $page_description = '';
            if(Auth::guard('admin')->check()){
             $members = Member::withCount('medicines')->simplePaginate(10);
             
            return response()->view('dashboard.member.index', compact('members', 'page_title', 'page_description'));
        }else{
            $clink = clink::find(Auth::user()->id);
            if ($clink->model == 'clink'| $clink->model == 'admin') {
              $members = Member::where('clink_id', Auth::user()->id)->withCount('medicines')->simplePaginate(10);
            return response()->view('dashboard.member.index', compact('members', 'page_title', 'page_description')); 
        } elseif ($clink->model == 'user') {
                $members = Member::where('clink_id', Auth::user()->sub_clink_id)->withCount('medicines')->simplePaginate(10);
                return response()->view('dashboard.member.index', compact('members', 'page_title', 'page_description')); 
        }
        }
        // } else {
        //     return response()->view('dashboard.error-6');
        // }
    }

    public function indexMedic($id)
    {
         $page_title = 'members';
        $page_description = '';
        if (Auth::guard('admin')->check()) {
            $medic = memberMedicine::where('member_id', $id)->simplePaginate(10);
        } else {
            $medic = memberMedicine::where('member_id', $id)->simplePaginate(10);
         }
        return response()->view('dashboard.member.medic', compact('medic', 'page_title', 'page_description'));

    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (ControllersService::checkPermission('create-member', 'admin')) {
        $page_title = 'members';
        $page_description = '';
        
         return response()->view('dashboard.member.create', compact('page_title', 'page_description'));
        // } else {
        //     return response()->view('dashboard.error-6');
        // }
    }

    public function createMember($id)
    {
        //
        return response()->view('dashboard.member.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        $clink = clink::find(Auth::user()->id);
        if ($clink->model == 'clink' | $clink->model == 'admin') {
            $emirates_id = 'required|digits:15|numeric|unique:members,emirates_id,Null,emirates_id,clink_id,' . Auth::user('clink')->id ;
            $email = 'required|email|unique:members,email,Null,email,clink_id,' . Auth::user('clink')->id;

        } elseif ($clink->model == 'user') {
            $emirates_id = 'required||digits:15|numeric|unique:members,emirates_id,Null,emirates_id,clink_id,' . Auth::user('clink')->sub_clink_id;
            $email = 'required|email|unique:members,email,Null,email,clink_id,' . Auth::user('clink')->sub_clink_id;

        }
         $validator = Validator($request->all(), [
            'first_name' => 'required|string|min:3|max:35',
            'last_name' => 'required|string|min:3|max:35',
            'mobile' => 'required|numeric',
            
            'Company' => 'required|string|min:3|max:35',
            'emirates_id' => $emirates_id,
            'email' => $email,
            'image' => 'required|image|max:2048|mimes:png,jpg,jpeg',
        ]);
         if (!$validator->fails()) {
            $member = new Member();

            if (request()->hasFile('image')) {
                $image = $request->file('image');;
                $imageName = time() . '_member.' . $image->getClientOriginalExtension();
                $image->move('members', $imageName);
                $member->image = $imageName;
             }
            // $member->clink_id = $request->get('clink_id');
            $member->Company = $request->get('Company');
            $member->first_name = $request->get('first_name');
            $member->last_name = $request->get('last_name');
            $member->mobile = $request->get('mobile');
            $member->emirates_id = $request->get('emirates_id');
            $member->email = $request->get('email');
            $member->status = 'active';
            
            if ($clink->model == 'clink'| $clink->model == 'admin') {
            $member->clink_id = Auth::user()->id;
            } elseif ($clink->model == 'user') {
                $member->clink_id = Auth::user()->sub_clink_id;
            }
            

            $isSaved = $member->save();
            $medicines = $request->medicine;
            for ($i = 0; $i < count($medicines); $i++) {
                $medicine = new memberMedicine();
                $medicine->medicine = $medicines[$i];
                $medicine->member_id = $member->id;
                $medicine->save();
            }
            if ($isSaved) {
                return ['redirect' => route('members.index')];
                 return response()->json(['icon' => 'success', 'title' => 'member created successfully'], $isSaved ? 201 : 400);
            } else {
                return response()->json(['message' => "Failed to save"], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }
    public function ajaxMemberStatus(Request $request)
    {
        $member = Member::find($request->id);
         $member->status = $request->member_toggle_value;
        $member->save();
        return true
        ;
    }
    public  function storeMedic(Request $request)
    {
        $validator = Validator($request->all(), [
            'medicine' => 'required|string|min:3|max:35',
  
        ]);
        if (!$validator->fails()) {
        $medicine = new memberMedicine();
        $medicine->medicine = $request->get('medicine');
        $medicine->member_id = $request->get('member_id');
       $isSaved= $medicine->save();
        if ($isSaved) {
             return response()->json(['icon' => 'success', 'title' => 'Medicine created successfully'], $isSaved ? 201 : 400);
            }else {
                return response()->json(['message' => "Failed to save"], 400);
            }
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
         
        $member = Member::find($id);

        return response()->view('dashboard.member.edit', compact('id', 'member'));

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
 
          $clink = clink::find(Auth::user()->id);
         if ($clink->model == 'clink' | $clink->model == 'admin') {
            $emirates_id = 'required|digits:15|numeric|unique:members,emirates_id,Null,emirates_id,clink_id,' . Auth::user('clink')->id ;
            $email = 'required|email|unique:members,email,Null,email,clink_id,' . Auth::user('clink')->id;

        } elseif ($clink->model == 'user') {
            $emirates_id = 'required||digits:15|numeric|unique:members,emirates_id,Null,emirates_id,clink_id,' . Auth::user('clink')->sub_clink_id;
            $email = 'required|email|unique:members,email,Null,email,clink_id,' . Auth::user('clink')->sub_clink_id;
        }
        $validator = Validator($request->all(), [
            'first_name' => 'required|string|min:3|max:35',
            'last_name' => 'required|string|min:3|max:35',
             'emirates_id' => $emirates_id,
              'email' => $email,
            'email' => 'email|unique:members,email,' . $userId,
            'Company' => 'required|string|min:3|max:35',
             'image' => 'required|image|max:2048|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {
            $member = Member::find($id);

            if (request()->hasFile('image')) {
                $image = $request->file('image');;
                $imageName = time() . '_member.' . $image->getClientOriginalExtension();
                $image->move('members', $imageName);
                $member->image = $imageName;
            }
            $member->clink_id = $request->get('clink_id');
            $member->Company = $request->get('Company');
            $member->first_name = $request->get('first_name');
            $member->last_name = $request->get('last_name');
            $member->mobile = $request->get('mobile');
            $member->emirates_id = $request->get('emirates_id');
            $member->email = $request->get('email');
            $member->status = 'active';
            $member->clink_id = Auth::user()->sub_clink_id;
            $isSaved = $member->save();      
            if ($isSaved) {
                return ['redirect' => route('members.index')];
                return response()->json(['icon' => 'success', 'title' => 'member created successfully'], $isSaved ? 201 : 400);
            } else {
                return response()->json(['message' => "Failed to save"], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }
   public function updates(Request $request)
    {
        $member = Member::find($request->get('id'));
        $clinks = clink::find(Auth::user()->id);
        // if ($clink->model == 'clink' | $clink->model == 'admin') {
        //     $emirates_id = 'digits:15|numeric|emirates_id|unique:members,id,' . $member->id . ',emirates_id,clink_id,' .  Auth::user('clink')->id;
        //     $email= 'required|email|unique:members,id,' . $member->id . ',Null,email,clink_id,'. Auth::user('clink')->id;
        // } elseif ($clink->model == 'user') {
        //     $emirates_id = 'digits:15|numeric|unique:members,emirates_id,Null,emirates_id,clink_id,' . Auth::user('clink')->sub_clink_id.',id,'.$member->id;
        //      $email= 'required|email|unique:members,id,' . $member->id . ',Null,email,clink_id,'.  Auth::user('clink')->sub_clink_id;

        // }
        
       $roles = [
            'first_name' => 'required|string|min:3|max:35',
 
            'last_name' => 'required|string|min:3|max:35',
            'mobile' => 'required|numeric',
            'Company' => 'required|string|min:3|max:35',
         ] ;
            if($clinks->model == 'clink' | $clinks->model == 'admin'){
            $clink=  Auth::user('clink')->id;
         }elseif($clinks->model == 'user'){
            $clink =  Auth::user('clink')->sub_clink_id;
         }
        $valdite =  Member::where('emirates_id', $request->get('emirates_id'))->where('id', '!=' ,$member->id)->where('clink_id', $clink)->first();
        $valditeEmail =  Member::where('email', $request->get('email'))->where('id', '!=' ,$member->id)->where('clink_id', $clink)->first();
         
      if($valdite != null){
            
      return response()->json(['icon' => 'error', 'title' => 'emirates id is used']);
      }
       if ($valditeEmail != null) {
            return response()->json(['icon' => 'error', 'title' => 'email is used']);
        }
        if ($member->emirates_id == $request->get('emirates_id') | $member->emirates_id != $request->get('emirates_id') && $member->clink_id == $clink) {
        
         if ($member->email == $request->get('email') | $member->email != $request->get('email') && $member->clink_id == $clink) {

        $validator = Validator::make($request->all(), $roles);
        if (!$validator->fails()) {
            

            if (request()->hasFile('image')) {
                $image = $request->file('image');;
                $imageName = time() . '_member.' . $image->getClientOriginalExtension();
                $image->move('members', $imageName);
                $member->image = $imageName;
            }
            $member->clink_id = $request->get('clink_id');
            $member->Company = $request->get('Company');
            $member->first_name = $request->get('first_name');
            $member->last_name = $request->get('last_name');
            $member->mobile = $request->get('mobile');
            $member->emirates_id = $request->get('emirates_id');
            $member->email = $request->get('email');
            $member->status = 'active';
            $member->clink_id = Auth::user()->sub_clink_id;
            $isSaved = $member->save();
            if ($isSaved) {
                // return ['redirect' => route('members.index')];
                return response()->json(['icon' => 'success', 'title' => 'member created successfully'], $isSaved ? 201 : 400);
            } else {
                return response()->json(['message' => "Failed to save"], 400);
            }
       
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
         } else {
                return response()->json(['icon' => 'error', 'title' => 'email id is used']);
            }
         } else {
                return response()->json(['icon' => 'error', 'title' => 'emirates id is used']);
            }
      
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($member,memberMedicine $memberMedicine)
    {
      
   $isDeleted = memberMedicine::find($member)->destroy($member);
        if($isDeleted){
            return back();
        }else{
            dd($id);
        }
        
    }
    public function destroyMedic($id,memberMedicine $memberMedicine)
    {
   $isDeleted = memberMedicine::find($id)->destroy($id);
        if($isDeleted){
            return back();
        }else{
     return back();
        }
    }
     public function serach(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            $members = Member::withCount('medicines')->get();
         
        $render = view('dashboard.member._search', ['members' => $members])->render();
        return response()->json(['html' => $render]);
         } else {
            $clink = clink::find(Auth::user()->id);
            if ($clink->model == 'clink' | $clink->model == 'admin') {
                if($request->text != null){
                    $members = Member::where('clink_id', Auth::user()->id)->withCount('medicines')->where('first_name', 'like', '%' . $request->text . '%')
                ->oRwhere('emirates_id', 'like', '%' . $request->text . '%')
                ->oRwhere('Company', 'like', '%' . $request->text . '%')
                ->get();  
                }else{
                     $members = Member::where('clink_id', Auth::user()->id)->withCount('medicines')->get();
                }
              
                
        $render = view('dashboard.member._search', ['members' => $members])->render();
        return response()->json(['html' => $render]);
             } elseif ($clink->model == 'user') {
                  if($request->text != null){
                $members = Member::where('clink_id', Auth::user()->sub_clink_id)->withCount('medicines')->where('first_name', 'like', '%' . $request->text . '%')
                ->oRwhere('emirates_id', 'like', '%' . $request->text . '%')
                ->oRwhere('Company', 'like', '%' . $request->text . '%')
                ->get();
                  }else{
                     $members = Member::where('clink_id', Auth::user()->sub_clink_id)->withCount('medicines')->get();
                }
               
        $render = view('dashboard.member._search', ['members' => $members])->render();
        return response()->json(['html' => $render]);
             }
        }
 

    }
}
