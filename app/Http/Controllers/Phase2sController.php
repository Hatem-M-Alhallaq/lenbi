<?php

namespace App\Http\Controllers;

use App\Models\application;
use App\Models\Phase1s;
use App\Models\Phase2;
use Illuminate\Http\Request;

class Phase2sController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($app_id)
    {
       // dd($_GET['app_id']);
        return view('frontend.wiz_pages.form-wizard-1-2',compact('app_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('dashboard.phases.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $validator = Validator($data, [
            'app_id' => 'required',
            'full_namme' => 'required|string',
            'id_number' => 'required',
            'owner_precentage' => 'nullable|string',
            'dab' => 'nullable|string',
            'spouse_name' => 'nullable|string',
            'spouse_id' => 'nullable|string',
            'spouse_ocupation' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'is_owned_house' => 'nullable|string',
            'amount' => 'nullable|string',
        ]);

        if (!$validator->fails()) {
            $phase2s = new Phase2();
            $phase2s->app_id = $request->get('app_id')  ;
            $phase2s->full_namme = $request->get('full_namme');
            $phase2s->id_number = $request->get('id_number');
            $phase2s->owner_precentage = $request->get('owner_precentage');
            $phase2s->dab = strtotime($request->get('dab'));
            $phase2s->spouse_name = $request->get('spouse_name');
            $phase2s->spouse_id = $request->get('spouse_id');
            $phase2s->spouse_ocupation = $request->get('spouse_ocupation');
            $phase2s->address = $request->get('address');
            $phase2s->email = $request->get('email');
            $phase2s->phone = $request->get('phone');
            $phase2s->is_owned_house =$request->get('is_owned_house');
            $phase2s->amount =$request->get('amount');
            $phase2s->is_completed  =1;
            $isSaved = $phase2s->save();
            $app_id=  $phase2s->app_id;
            if ($isSaved) {
                return redirect()->route('phase3.index',compact('app_id'));
            } else {
                //return response()->json(['icon' => 'error', 'title' => 'Updated Faild'], 400);
            }

        } else {
            //return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
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
    public function update(Request $request, Phase1s $phase1s)
    {
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
