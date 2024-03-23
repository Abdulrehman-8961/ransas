<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use DateTime;
use Auth;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view("calender");
    }

    public function getEvents(Request $request) {
        $start = $request->input('start');
        $end = $request->input('end');

        // $events = Event::whereBetween('start_date', [$start, $end])->get();
        if (Auth::user()->role == "Admin") {
            $events = DB::table('events')
            ->where('is_deleted', 0)
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_date', [$start, $end])
                    ->orWhereBetween('end_date', [$start, $end])
                    ->orWhere(function ($query) use ($start, $end) {
                        $query->where('start_date', '<', $start)
                                ->where('end_date', '>', $end);
                    });
            })
            ->get();
        } else {
            $events = DB::table('events')
            ->where('pool_id', Auth::user()->id)
            ->where('is_deleted', 0)
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_date', [$start, $end])
                    ->orWhereBetween('end_date', [$start, $end])
                    ->orWhere(function ($query) use ($start, $end) {
                        $query->where('start_date', '<', $start)
                                ->where('end_date', '>', $end);
                    });
            })
            ->get();



        }

        $formattedEvents = [];
        foreach ($events as $event) {
        // dd($event->id);
            $start_date = $event->start_date;
            $start_time = $event->start_time;
            $end_date = $event->end_date;
            $end_time = $event->end_time;
            $startDateTime = new DateTime($start_date . ' ' . $start_time);
            $endDateTime = new DateTime($end_date . ' ' . $end_time);

            $intervalDays = $startDateTime->diff($endDateTime)->format('%a');

            $intervalHours = $startDateTime->diff($endDateTime)->format('%h');
            $intervalMinutes = $startDateTime->diff($endDateTime)->format('%i');
            // dd($intervalDays,$intervalHours,$intervalMinutes);
            $formattedEvents[] = [
                'bookid' => $event->id,
                'customer_name' => $event->customer_name,
                'customer_email' => $event->customer_email,
                'customer_phone' => $event->customer_phone,
                'interval_Days' => $intervalDays,
                'interval_Hours' => $intervalHours,
                'interval_Minutes' => $intervalMinutes,
                'payment_status' => $event->payment_status,
                'payment_method' => $event->payment_method,
                'total_payment' => $event->total_payment,
                'date_start' => $event->start_date,
                'date_end' => $event->end_date,
                'start_time' => $event->start_time,
                'end_time' => $event->end_time,
                'book_type' => $event->booking_type,
                'title' => $event->booking_type,
                'start' => $event->start_date,
                'end' => $event->end_date,
                'percentage_value' => $event->percentage_value,
                "extendedProps" => [
                    "calendar" => "$event->color"
                ],
            ];
        }

        return response()->json(['events' => $formattedEvents]);
    }

    public function updateEvents(Request $request, $id) {
        $event_title = $request->type;
        $event_color = $request->event_level;

        $startdate = date('Y-m-d', strtotime($request->input('start_date')));
        $enddate = date('Y-m-d', strtotime($request->input('end_date')));


        $starttime = date('H:i', strtotime($request->input('start_time')));
        $endtime = date('H:i', strtotime($request->input('end_time')));

        // dd($request);

        if($event_title && $id){
           $save = DB::table('events')->where('id',$id)->update([
                'booking_type' => $event_title,
                "customer_name" => $request->input('customer_name'),
                "start_date" => $startdate,
                "start_time" => $starttime,
                "end_date" => $enddate,
                "end_time" => $endtime,
                "customer_email" => $request->input('customer_email'),
                "customer_phone" => $request->input('customer_phone'),
                "total_payment" => $request->input('total_payment'),
                "payment_method" => $request->input('payment_method'),
                "payment_status" => $request->input('payment_status'),
                "percentage_value" => $request->input('percentage_value'),
                'color' => $event_color,
            ]);
            if($save){
                DB::table('log_history')->insert([
                    'user_id' => Auth::user()->id,
                    'description' => "Updated Event ".$request->input('type')." For Client: ".ucFirst($request->input('customer_name'))."",
                    'page' => 'Edit Event'
                ]);
            }
            return redirect()->back()->with('success', "Event Updated");
        }
        return redirect()->back()->with('error', "Something went wrong");
    }

    public function changeEventTime(Request $request){
        $booking_id = $request->input('eventId');
        $start_time = $request->input('newStart');
        $end_time = $request->input('newEnd');

        $update = DB::table('events')->where('id',$booking_id)->update([
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);

        return response()->json(['success' => (bool)$update]);
    }

}
