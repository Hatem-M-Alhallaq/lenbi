<?php

namespace App\Http\Controllers;

use App\Models\application;
use App\Models\Phase1s;
use App\Models\Phase2;
use App\Models\Phase3;
use Illuminate\Http\Request;

class Phase3sController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($app_id)
    {
        //dd($app_id);
        return view('frontend.wiz_pages.form-wizard-1-3',compact('app_id'));
    }
    public function phase3a($app_id)
    {
        //dd($app_id);
        return view('frontend.wiz_pages.form-wizard-1-3-1',compact('app_id'));
    }
    public function phase3b($app_id)
    {
        //dd($app_id);
        return view('frontend.wiz_pages.form-wizard-1-3-2',compact('app_id'));
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
            'have_you_prvieos' => 'required|integer',
        ]);

        if (!$validator->fails()) {
            $phase3s = new Phase3();
            $phase3s->app_id = $request->get('app_id');
            $phase3s->have_you_prvieos = $request->get('have_you_prvieos');
            $isSaved = $phase3s->save();
            $app_id = $phase3s->app_id;
            if ($isSaved) {
                return redirect()->route('phase3a.index',compact('app_id'));
            } else {
                //return response()->json(['icon' => 'error', 'title' => 'Updated Faild'], 400);
            }

        } else {
            //return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }
    public function phase3a_store(Request $request)
    {

        $data = $request->all();

        $validator = Validator($data, [
            'app_id' => 'required',
            'have_you_prvieos' => 'required|integer',
        ]);

        if (!$validator->fails()) {
            $phase3s = new Phase3();
            $phase3s->app_id = $request->get('app_id');
            $phase3s->have_you_prvieos = $request->get('have_you_prvieos');
            $isSaved = $phase3s->save();
            $app_id = $phase3s->app_id;
            if ($isSaved) {
                return redirect()->route('phase3b.index',compact('app_id'));
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
