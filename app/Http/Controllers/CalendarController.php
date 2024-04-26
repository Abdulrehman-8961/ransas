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

    public function index(Request $request)
    {
        $pool_data = DB::table('pool')->where('id', @$request['pool_select'])->first();
        $start_times = [];
        $end_times = [];
        if ($pool_data) {
            // Split available days into an array
            $available_days = explode(', ', $pool_data->availble_days);
            $available_days = array_filter($available_days);

            // Extract start time and end time for each available day
            foreach ($available_days as $day) {
                // Construct column names for start time and end time
                $start_column = strtolower(substr($day, 0, 3)) . '_start_time';
                $end_column = strtolower(substr($day, 0, 3)) . '_end_time';

                // For other days, use regular column names
                $start_times[$day] = $pool_data->$start_column;
                $end_times[$day] = $pool_data->$end_column;
            }
        }
        return view("calender", [
            'startTimes' => $start_times,
            'endTimes' => $end_times,
        ]);
    }

    public function getEvents(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');
        $pool_select = $request->input('pool_select');
        $events = DB::table('events')
            ->where('pool_id', $pool_select)
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

        $formattedEvents = [];
        foreach ($events as $event) {
            $pool = DB::table('pool')->where('id', $event->pool_id)->first();
            if ($pool) {
                $options = explode(', ', $pool->payments);
                $html = '<option value="">Select Payment Method</option>';
                foreach ($options as $option) {
                    $html .= '<option value="' . $option . '">' . $option . '</option>';
                }
            } else {
                $html = '';
            }
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
                'pool' => $event->pool_id,
                'payment_options' => $html,
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

    public function updateEvents(Request $request, $id)
    {
        $event_title = $request->type;
        $event_color = $request->event_level;

        $startdate = date('Y-m-d', strtotime($request->input('start_date')));
        $enddate = date('Y-m-d', strtotime($request->input('end_date')));


        $starttime = date('H:i', strtotime($request->input('start_time')));
        $endtime = date('H:i', strtotime($request->input('end_time')));

        // dd($request);

        if ($event_title && $id) {
            $save = DB::table('events')->where('id', $id)->update([
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
            if ($save) {
                DB::table('log_history')->insert([
                    'user_id' => Auth::user()->id,
                    'description' => "Updated Event " . $request->input('type') . " For Client: " . ucFirst($request->input('customer_name')) . "",
                    'page' => 'Edit Event'
                ]);
            }
            return redirect()->back()->with('success', "האירוע עודכן");
        }
        return redirect()->back()->with('error', "משהו השתבש");
    }

    public function changeEventTime(Request $request)
    {
        $booking_id = $request->input('eventId');
        $start_time = $request->input('newStart');
        $end_time = $request->input('newEnd');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $update = DB::table('events')->where('id', $booking_id)->update([
            'start_time' => $start_time,
            'end_time' => $end_time,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        return response()->json(['success' => (bool)$update]);
    }

    public function fetchData(Request $request)
    {
        $pool = $request->input('pool');
        $date = $request->input('date');
        $dateParts = explode(' - ', $date);
        $startdate = date('Y-m-d', strtotime($dateParts[0]));
        $enddate = date('Y-m-d', strtotime($dateParts[1]));
        // dd($startdate,$enddate,$pool);
        $search = $request->input('search');
        $events = $request->input('events');


        $query = DB::table('events')->where('pool_id', $pool)->where('start_date','>=',$startdate)->where('start_date','<=',$enddate);

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%$search%");
            });
        }
        if (!empty($events)) {
            $query->whereIn('booking_type', $events);
        }

        $data = $query->get();

        // dd($data);
        foreach ($data as $item) {
            $startDateTime = new DateTime($item->start_date . ' ' . $item->start_time);
            $endDateTime = new DateTime($item->end_date . ' ' . $item->end_time);
            $duration = $startDateTime->diff($endDateTime);
            $hours = $duration->h + ($duration->days * 24);
            $item->duration_hours = $hours;

            $item->day_of_week = $startDateTime->format('l');
        }
        return response()->json($data);
    }
}
