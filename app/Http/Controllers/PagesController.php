<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\clink;
use App\Models\event;
use App\Models\hour;
use App\Models\Member;
use App\Models\model_has_role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';

        return response()->view('pages.dashboard');

    }

    public function storeEvent(Request $request)
    {

        $validator = Validator($request->all(), [
            'title' => 'required|string|min:3|max:35',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'user_id' => 'required',
        ]);
        if (!$validator->fails()) {
            $clinks = clink::find(Auth::user()->id);
            if ($clinks->model =='clink' | $clinks->model == 'admin') {
                $clink = $clinks->id ;
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
                if ($rhythm_of_visit >= $days) {
                    return response()->json(['icon' => 'error', 'title' => 'this member cant visit']);
                }
            }


            $save = event::create([
                'title'        =>    $request->title,
                'start'        =>    $request->start,
                'end'            =>        $request->end,
                'clink_id'        =>       $clink,
                'member_id'        =>    $request->user_id,
            ]);
            if ($save) {
                return response()->json(['icon' => 'success', 'title' => 'event created successfully']);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }
    public function action(Request $request)
    {

        if ($request->ajax()) {

            if ($request->type == 'update') {
                $event = event::find($request->id)->update([
                    'title'        =>    $request->title,
                    'start'        =>    $request->start,
                    'end'        =>    $request->end,
                ]);

                return response()->json(['icon' => 'success', 'title' => 'event edit successfully']);
            }

            // if (ControllersService::checkPermission('check_in', 'clink') && $request->type == 'check_in') {

            $event = event::find($request->id);
            $member = $event->member ;
            if ($member->status == 'block') {
                return response()->json(['icon' => 'error', 'title' => 'this user Blocked']);
            }
            if ($request->type == 'check_in') {
            if (Carbon::parse($event->start)->format('Y-m-d H:i') < Carbon::now()->format('Y-m-d H:i')) {
                return response()->json(['icon' => 'error', 'title' => 'you are late you cant visit']);
            }
            }
            if ($request->type == 'check_in') {

                 if ($event->start > Carbon::now()) {
                    return response()->json(['icon' => 'error', 'title' => 'you are late you cant visit']);
                }
                $event->check_in = Carbon::now();
                $event->save();
                return response()->json(['icon' => 'success', 'title' => 'event edit successfully']);
            }
            if ($request->type == 'check_out') {
                 if ($event->check_in == null)
                    $event->check_in = Carbon::now();

                $event->check_out = Carbon::now();
                $event->save();

                return response()->json(['icon' => 'success', 'title' => 'event edit successfully']);
            }

            if ($request->type == 'delete') {
                event::find($request->id)->delete();
                return response()->json(['icon' => 'success', 'title' => 'event delete successfully']);
            }
        }
    }
    public function check(Request $request)
    {


                   $event = event::find($request->event_id);
                $member = $event->member;
                if ($member->status == 'block') {
                    return response()->json(['icon' => 'error', 'title' => 'this user Blocked']);
                }
                     if ($event->check_in == null) {
                if ($request->type == 'check_in') {
                    if (Carbon::parse($event->start)->format('Y-m-d H:i') < Carbon::now()->format('Y-m-d H:i')) {
                        return response()->json(['icon' => 'error', 'title' => 'you are late you cant visit']);
                    }
            }
                }
                    if($event->check_in == null){
                    $event->check_in = Carbon::now();
                    $event->save();
                    return response()->json(['icon' => 'success', 'title' => 'event edit successfully']);
                }

                    if ($event->check_in != null)

                    $event->check_out = Carbon::now();
                    $event->save();
                    return response()->json(['icon' => 'success', 'title' => 'event edit successfully']);


    }
    /**
     * Demo methods below
     */

    // Datatables
    public function datatables()
    {
    }

    // KTDatatables


    // Select2
    public function select2()
    {
        $page_title = 'Select 2';
        $page_description = 'This is Select2 test page';

        return view('pages.select2', compact('page_title', 'page_description'));
    }

    // custom-icons
    public function customIcons()
    {
        $page_title = 'customIcons';
        $page_description = 'This is customIcons test page';

        return view('pages.icons.custom-icons', compact('page_title', 'page_description'));
    }

    // flaticon
    public function flaticon()
    {
        $page_title = 'flaticon';
        $page_description = 'This is flaticon test page';

        return view('pages.icons.flaticon', compact('page_title', 'page_description'));
    }

    // fontawesome
    public function fontawesome()
    {
        $page_title = 'fontawesome';
        $page_description = 'This is fontawesome test page';

        return view('pages.icons.fontawesome', compact('page_title', 'page_description'));
    }

    // lineawesome
    public function lineawesome()
    {
        $page_title = 'lineawesome';
        $page_description = 'This is lineawesome test page';

        return view('pages.icons.lineawesome', compact('page_title', 'page_description'));
    }

    // socicons
    public function socicons()
    {
        $page_title = 'socicons';
        $page_description = 'This is socicons test page';

        return view('pages.icons.socicons', compact('page_title', 'page_description'));
    }

    // svg
    public function svg()
    {
        $page_title = 'svg';
        $page_description = 'This is svg test page';

        return view('pages.icons.svg', compact('page_title', 'page_description'));
    }

    // Quicksearch Result
    public function quickSearch()
    {
        return view('layout.partials.extras._quick_search_result');
    }
}
