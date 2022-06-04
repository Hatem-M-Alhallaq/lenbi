<?php

namespace App\Http\Controllers;

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
        //
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
    public function store(Request $request)
    {
        //
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
        $data = $request->all() ;
        $validator = Validator($data, [
            'company_name' => 'required|string|min:3',
            'company_number' => 'required|integer',
            'bank_name' => 'nullable|string',
        ]);

        if (!$validator->fails()) {

         $$isSaved=  $phase1s->update($data);

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
