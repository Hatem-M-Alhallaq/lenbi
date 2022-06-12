<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.index');

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
    public function msg_v()
    {
        return view('frontend.wiz_pages.confirm-message');

    }
    public function plane()
    {
        return view('frontend.wiz_pages.plane');

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request);
        $data = $request->all();
        $validator = Validator($data, [
            'full_name' => 'required|string|min:3',
            'uid' => 'required|integer',
            'phone' => 'nullable|string',
        ]);
        $client = new Client();
        $client->full_name = $request->get('full_name');
        $client->identification_number = $request->get('uid');
        $client->mmobile = $request->get('phone');
        $client->code = 1907;
        $client->user_type = 1;
        $isSaved = $client->save();
        if ($isSaved) {
            $set_sess = session(['identification_number' => $request->get('uid')]);
            return redirect()->route('frontend.msg_v');
        } else {
            return back();
        }
    }
    public function verification_check(Request $request)
        {

            $identification = session('identification_number');
            $code = $request->get('confirmation_code');
            $user = Client::where('identification_number',$identification)->first();

            if($user->code == $code)
            {
                $user->is_verified = 1;
                $isUpdated= $user->save();
                if ($isUpdated) {
                    //auth()->login($user);
                    //Session::forget('identification_number');
                 //  $logedin = auth()->attempt(array('identification_number' => $user['identification_number'], 'code' => $user->code));
                    //dd("kk");
                    return redirect()->route('frontend.plane');

                } else {
                    return back();
                }
            }else
            {
                return redirect()->route('frontend.msg_v');
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

    public function register()
    {
        return view('frontend.index');
    }
}
