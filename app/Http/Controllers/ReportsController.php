<?php

namespace App\Http\Controllers;

use App\Models\clink;
use App\Models\event;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class ReportsController extends Controller
{
    public function event(Request $request)
    {
        // make filter
        // - by member 
        // - by date 
        // - by clink
        $filter_member_id = (int) $request->member_id;
        $filter_clink_id  = (int) $request->clink_id;

        if (Auth::guard('admin')->check()) {
            $events = event::with(['member', 'clink']);
        } elseif (Auth::guard('clink')->check()) {
            $clink = clink::find(Auth::user()->id);
            if ($clink->model == 'clink' | $clink->model == 'admin') {

             $events = event::where('clink_id', Auth::user()->id)->with(['member', 'clink']);
                
            } elseif ($clink->model == 'user') {

                $events = event::where('clink_id', Auth::user()->sub_clink_id)->with(['member', 'clink']);
                

            }
        }
        if ($filter_member_id != 0)
            $events = $events->where('member_id', $filter_member_id);

        if ($filter_clink_id != 0)
            $events = $events->where('clink_id', $filter_clink_id);

    
        // filter by date
        if ($request->from)
            $events = $events->where('created_at', '>=', $request->from . ' 00:00:00');

        if ($request->to)
            $events = $events->where('created_at', '<=', $request->to . ' 00:00:00');


        $events = $events->get();

        return view('dashboard.reports.event', compact('events'));
    }

        public function serachVisitor(Request $request)
    {
 
        if (Auth::guard('admin')->check()) {
            $members = Member::with('clink')->where('first_name', 'like', '%' . $request->text . '%')
                ->oRwhere('emirates_id', 'like', '%' . $request->text . '%')
                ->oRwhere('Company', 'like', '%' . $request->text . '%')->get();
        } elseif (Auth::guard('clink')->check()) {

            $clink = clink::find(Auth::user()->id);
            if ($clink->model == 'clink' | $clink->model == 'admin') {
                if( $request->text != null){
                $members = Member::where('clink_id', Auth::user()->id)->with('clink')->where('first_name', 'like', '%' . $request->text . '%')
                    ->oRwhere('emirates_id', 'like', '%' . $request->text . '%')
                    ->oRwhere('Company', 'like', '%' . $request->text . '%')->get();
                }else{
                    $members = Member::where('clink_id', Auth::user()->id)->with('clink')->get();
                }
            } elseif ($clink->model == 'user') {
                if( $request->text != null){
                $members = Member::where('clink_id', Auth::user()->sub_clink_id)->with('clink')->where('first_name', 'like', '%' . $request->text . '%')
                    ->oRwhere('emirates_id', 'like', '%' . $request->text . '%')
                    ->oRwhere('Company', 'like', '%' . $request->text . '%')->get();
                }else{
                    $members = Member::where('clink_id', Auth::user()->sub_clink_id)->with('clink')->get();
                }
            }
        }
 
        $render = view('dashboard.reports._searchVisitor', ['members' => $members])->render();
        return response()->json(['html' => $render]);
    }
    public function visitors(Request $request)
    {
        // $events = event::with(['member', 'clink']);

        // if (Auth()->guard('clink')->user() !== null)
        //     $events = $events->where('clink_id', Auth()->guard('clink')->user()->id);

        // $events = $events->get();

        if(Auth::guard('admin')->check()){
         $members = Member::with('clink');
         }elseif (Auth::guard('clink')->check()) {

            $clink = clink::find(Auth::user()->id);
            if ($clink->model == 'clink' | $clink->model == 'admin') {
            $members = Member::where('clink_id', Auth::user()->id)->with('clink');
        } elseif ($clink->model == 'user') {

            $members = Member::where('clink_id', Auth::user()->sub_clink_id)->with('clink');

        }
        }
        if (isset($request->member_id))
            $members = $members->where('id', $request->member_id);


        $members = $members->get();

        return view('dashboard.reports.visitors', compact('members'));
    }




    public function event_xlsx(Request $request)
    {
        // make filter
        // - by member 
        // - by date 
        // - by clink
        $filter_member_id = (int) $request->member_id;
        $filter_clink_id  = (int) $request->clink_id;
        if (Auth::guard('admin')->check()) {
        $events = event::with(['member', 'clink']);
        } elseif (Auth::guard('clink')->check()) {
            $clink = clink::find(Auth::user()->id);
            if ($clink->model == 'clink' | $clink->model == 'admin') {
               
             $events = event::where('clink_id', Auth::user()->id)->with(['member', 'clink']);
            } elseif ($clink->model == 'user') {
                $events = event::where('clink_id', Auth::user()->sub_clink_id)->with(['member', 'clink']);
            }
        }
        if ($filter_member_id != 0)
            $events = $events->where('member_id', $filter_member_id);

        if ($filter_clink_id != 0)
            $events = $events->where('clink_id', $filter_clink_id);
        // // filter by date
        if ($request->from)
            $events = $events->where('created_at', '>=', $request->from . ' 00:00:00');

        if ($request->to)
            $events = $events->where('created_at', '<=', $request->to . ' 00:00:00');


        $events = $events->get();
        
          foreach ($events as $event) {
               if ($event->check_out > $event->end){
            $check = 'late';
        }else{
                $check = 'in time';   
        }
          $statData =Carbon::parse($event->start)->format('Y-m-d');
         $statTime = Carbon::parse($event->start)->format(' H:i:s');
         $endData =Carbon::parse($event->end)->format('Y-m-d');
         $endTime = Carbon::parse($event->end)->format(' H:i:s');
         
           $checkData =Carbon::parse($event->check_in)->format('Y-m-d');
         $checkTime= Carbon::parse($event->check_in)->format(' H:i:s');
          $checkOutData =Carbon::parse($event->check_out)->format('Y-m-d');
         $checkOutTime= Carbon::parse($event->check_out)->format(' H:i:s');
         
              $data[] = [
                'Visitor ID' => $event->member->id,
                'Visitor Name' => $event->member->first_name . ' ' . $event->member->last_name,
                'Visitor Company' => $event->member->Company,
                'Clinic Info' => $event->clink->Username,
                'title' => $event->title,
                'Start Date' => $statData,
                  'Start Time' => $statTime,

                'End Date' => $endData,
                  'End Time' => $endTime,

                ' Check in Date' => $checkData,
                 ' Check in Time  ' => $checkTime,

                 'Check out Date' => $checkOutData,
                 ' Check out Time' => $checkOutTime,
                'is late' => $check,

            ];
        }

        if (empty($data))
            return back();

        $list = collect($data);
        return (new \Rap2hpoutre\FastExcel\FastExcel($list))->download('file.xlsx');
    }
    public function visitors_xlsx(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            $members = Member::with('clink');
        } elseif (Auth::guard('clink')->check()) {
            $clink = clink::find(Auth::user()->id);
            if ($clink->model == 'clink' | $clink->model == 'admin') {
            $members = Member::where('clink_id', Auth::user()->id)->with('clink');
        } elseif ($clink->model == 'user') {
                $members = Member::where('clink_id', Auth::user()->sub_clink_id)->with('clink');

        }
        }

        if (isset($request->member_id))
            $members = $members->where('id', $request->member_id);


        $members = $members->get();
        foreach ($members as $member) {
            $medicines = $member->medicines->pluck('medicine')->toArray();
            $data[] = [
                'ID' => $member->id,
                'Image' => '<img  width="50" height="50" class="rounded-circle img-thumbnail" src="' . asset('members/' . $member->image) . '" alt="">',
                'Name' => $member->first_name . ' ' . $member->last_name,
                'Mobile' => $member->mobile,
                'Email' => $member->email,
                'Company' => $member->Company,
                'Emirates ID' => $member->emirates_id,
                'Medicines' => implode(' - ', $medicines),
                'Status' => $member->status,
                'Craeted by Clinic' => $member->clink->Username,
            ];
        }
       if (empty($data))
            return back();
        $list = collect($data);
        return (new \Rap2hpoutre\FastExcel\FastExcel($list))->download('file.xlsx');
    }
}
