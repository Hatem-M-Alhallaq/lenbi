<?php

namespace App\Http\Controllers;

use App\Models\clink;
use App\Models\event;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class eventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (ControllersService::checkPermission('index-member', 'admin')) {
        $page_title = 'events';
        $page_description = '';
        if (Auth::guard('admin')->check()) {
            $events = event::with(['member', 'clink'])->simplePaginate(10);
              $member = Member::all();
                $memberDis = Member::where('status', 'block')->get();
            return response()->view('dashboard.event.index', compact('events', 'page_title', 'page_description', 'member', 'memberDis'));
        } else {
            $clink = clink::find(Auth::user()->id);
            if ($clink->model == 'clink'| $clink->model == 'admin') {
            $events = event::where('clink_id', Auth::user()->id)->with(['member', 'clink'])->simplePaginate(10);
                $member = Member::where('clink_id', Auth::user()->id)->where('status', 'active')->get();
                $memberDis = Member::where('clink_id', Auth::user()->id)->where('status', 'block')->get();
            return response()->view('dashboard.event.index', compact('events', 'page_title', 'page_description', 'member', 'memberDis'));
            } elseif ($clink->model == 'user') {
                $member = Member::where('clink_id', Auth::user()->sub_clink_id)->where('status', 'active')->get();
                $memberDis = Member::where('clink_id', Auth::user()->sub_clink_id)->where('status', 'block')->get();
                $events = event::where('clink_id', Auth::user()->sub_clink_id)->with(['member', 'clink'])->simplePaginate(10);
                return response()->view('dashboard.event.index', compact('events', 'page_title','page_description', 'member', 'memberDis'));
            }
            
        }
        // } else {
        //     return response()->view('dashboard.error-6');
        // }
    }
      public function serach(Request $request)
    {
         $filter = $request->text;
        if (Auth::guard('admin')->check()) {
           
          
           $eventsData = event::whereHas('member', function ($query) use ($filter) {
                $query->where('first_name', 'like', '%' . $filter . '%');
                
        })->with(['member', 'clink'])->orWhere('title', 'like', '%' . $request->text . '%')->get();
              $render = view('dashboard.event._search', ['eventsData' => $eventsData])->render();
        return response()->json(['html' => $render]);
        }else{
            $clink = clink::find(Auth::user()->id);
         
        if ($clink->model == 'clink' | $clink->model == 'admin') {
            if($filter != null){
            $event = event::where('clink_id', Auth::user()->id);
         $eventsData =  $event
         ->whereHas('member', function ($query) use ($filter) {
                    $query->where('first_name', 'like', '%' . $filter . '%')->orWhere('last_name', 'like', '%' . $filter . '%')->orWhere('emirates_id', 'like', '%' . $filter . '%');
                })
         
         ->orWhere('title', 'like', '%' . $request->text . '%')->with(['member', 'clink'])->get();
         }else{
             
            $eventsData = event::where('clink_id', Auth::user()->id)->with(['member', 'clink'])->get();
  
         }
         $render = view('dashboard.event._search', ['eventsData' => $eventsData])->render();
        return response()->json(['html' => $render]);

         } elseif ($clink->model == 'user') {
         if($filter != null){   
            $event = event::where('clink_id', Auth::user()->sub_clink_id);
           $eventsData =  $event
         ->whereHas('member', function ($query) use ($filter) {
                    $query->where('first_name', 'like', '%' . $filter . '%')->orWhere('last_name', 'like', '%' . $filter . '%')->orWhere('emirates_id', 'like', '%' . $filter . '%');
                })->with(['member', 'clink'])->get();   
          }else{
             
         $eventsData = event::where('clink_id', Auth::user()->sub_clink_id)->with(['member', 'clink'])->get();
  
         }
         $render = view('dashboard.event._search', ['eventsData' => $eventsData])->render();
        return response()->json(['html' => $render]);
            }
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
        
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator($request->all(), [
            'title' => 'required|string|min:3|max:35',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'user_id' => 'required',
        ]);
        $clinks = clink::find(Auth::user()->id);
        if ($clinks->model == 'clink' | $clinks->model == 'admin') {
            $clink = $clinks->id;
        } elseif ($clinks->model == 'user') {
            $clink = $clinks->sub_clink_id;
        }
        // check rhythm_of_visit
        $rhythm_of_visit = Auth::user()->rhythm_of_visit;

        $lastEvent = event::where('clink_id', $clink)->where('member_id', $request->user_id)->orderBy('id', 'desc')->first();
        $ourDateOfWeek = Carbon::now()->dayOfWeekIso;
        $mytime = Carbon::now();
        $mytime->toDateTimeString();
        $format = 'G:i';
        $startOpen = Carbon::parse($request->start)->toTimeString();
        $startClose = Carbon::parse($request->end)->toTimeString();

        $daystart = (Carbon::parse($request->start)->dayOfWeekIso) - 1;
        $dayend = (Carbon::parse($request->end)->dayOfWeekIso) - 1;


        if ($clinks->model == 'clink' | $clinks->model == 'admin') {
            $clinkHour = clink::where('id', $clink)->first();
        } elseif ($clinks->model == 'user') {
            $clinkHour = clink::where('sub_clink_id', $clink)->first();
        }
        $openingTime = $clinkHour->hours && $clinkHour->hours[$daystart . '_from'] ? date($format, strtotime($clinkHour->hours[$daystart . '_from'])) : null;

        $closingTime = $clinkHour->hours && $clinkHour->hours[$dayend . '_to'] ? date($format, strtotime($clinkHour->hours[$dayend . '_to'])) : null;

        if ($openingTime == null) {
            return response()->json(['icon' => 'error', 'title' => 'Sorry, today is a holiday']);
        }

        if ($startOpen < Carbon::parse($openingTime)->addSecond(0)->toTimeString()) {
            return response()->json(['icon' => 'error', 'title' => 'this start meeting time out of working hours']);
        }

        if ($startClose > Carbon::parse($closingTime)->addSecond(0)->toTimeString()) {
            return response()->json(['icon' => 'error', 'title' => 'this end meeting time out of working hours']);
        }

        // end working hours
        if ($lastEvent != null) {
            $fdate = $lastEvent->start;
            $tdate = $request->start;
            $datetime1 = new \DateTime($fdate);
            $startTime = Carbon::parse($tdate);
            $time = $startTime->diff($fdate);
            $days = $time->d;

            //now do whatever you like with $days
            // if ($rhythm_of_visit >= $days) {
            //     return response()->json(['icon' => 'error', 'title' => 'this member cant visit']);
            // }
        }
        if (!$validator->fails()) {
            $visit = event::find($request->get('event_id'));
            $visit->title = $request->get('title');
            $visit->start = $request->get('start');
            $visit->end = $request->get('end');
            $visit->member_id = $request->get('user_id');
            $isSaved = $visit->save();
            if ($isSaved) {
            
                return response()->json(['icon' => 'success', 'title' => 'event updated successfully']);
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
