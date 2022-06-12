<?php

namespace App\Http\Controllers;

use App\Models\application;
use App\Models\Phase1s;
use Illuminate\Http\Request;

class Phase1sController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.wiz_pages.form-wizard-1-1');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.phases.edit');
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
            'company_name' => 'required|string|min:3',
            'company_number' => 'required|integer',
            'bank_name' => 'nullable|string',
        ]);

        if (!$validator->fails()) {

            $aplecation = new application();
            //$aplecation->user_id = auth()->user()->id;
            $aplecation->user_id = 1;
            $aplecation->app_type = 1;
            $aplecation->status = 0;
            $aplecation->start_date = date("y-m-d");
            $is_sa = $aplecation->save();
            if ($is_sa) {
            $phase1s = new Phase1s();
            $phase1s->application_id = $aplecation->id;
            $phase1s->company_name = $request->get('company_name');
            $phase1s->company_number = $request->get('company_number');
            $phase1s->bank_name = $request->get('bank_name');
            $phase1s->submit_date = date('y-m-d');
            $phase1s->is_completed = 1;
           // $phase1s->user_id = auth()->user()->id;
            $phase1s->user_id = 1;
            //$phase1s->user_type = auth()->user()->user_type;
            $phase1s->user_type = 1;
            // $Language->user()->associate($user);
            $isSaved = $phase1s->save();
            $app_id = $phase1s->application_id;
            if ($isSaved) {
                return redirect()->route('phase2.index',compact('app_id'));
            } else {
                //return response()->json(['icon' => 'error', 'title' => 'Updated Faild'], 400);
            }
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
    public function updateAjax(Request $request)
    {
        $data = $request->all();
        $validator = Validator($data, [
            'company_name' => 'required|string|min:3',
            'company_number' => 'required|integer',
            'bank_name' => 'nullable|string',
        ]);

        if (!$validator->fails()) {
            $phase1s = Phase1s::find($data['phase1s_id']);
            $phase1s->company_name = $request->get('company_name');
            $phase1s->company_number = $request->get('company_number');
            $phase1s->bank_name = $request->get('bank_name');
            // $Language->user()->associate($user);
            $isSaved = $phase1s->save();
            if ($isSaved) {
                return response()->json(['icon' => 'success', 'title' => 'Updated Success'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'Updated Faild'], 400);
            }
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
    }
}
