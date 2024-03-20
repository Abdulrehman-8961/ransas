<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Http;

class AddEventController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view("add-event");
    }
    public function save(Request $request)
        {
            $validated = $request->validate([
                "type" => 'required',
                "customer_name" => 'required',
                "start_date" => 'required',
                "end_date" => 'required',
                "start_time" => 'required',
                "end_time" => 'required',
                "customer_phone" => 'required',
                "customer_email" => 'required',
                "total_payment" => 'required',
                "payment_method" => 'required',
                "payment_status" => 'required',
            ]);
            $startdate = date('Y-m-d', strtotime($request->input('start_date')));
            $enddate = date('Y-m-d', strtotime($request->input('end_date')));


            $starttime = date('H:i', strtotime($request->input('start_time')));
            $endtime = date('H:i', strtotime($request->input('end_time')));

            if($validated) {
               $save = DB::table('events')->insert([
                    "pool_id" => Auth::user()->id,
                    "booking_type" => $request->input('type'),
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
                    "color" => $request->input('event_level'),
                    "percentage_value" => $request->input('percentage_value'),
                    "created_by" => Auth::user()->id
                ]);
                if($save){
                    DB::table('log_history')->insert([
                        'user_id' => Auth::user()->id,
                        'description' => "Added New Event ".$request->input('type')." For Client: ".ucFirst($request->input('customer_name'))."",
                        'page' => 'Add Event'
                    ]);
                }
                $start_date = date('d.m.Y', strtotime($request->input('start_date')));
                $end_date = date('d.m.Y', strtotime($request->input('end_date')));


                $message = <<<EOT
                New event added:
                Type: {$request->input('type')}.
                Customer: {$request->input('customer_name')}
                Date: $start_date - $end_date
                Time: $request->input('start_time') - $request->input('end_time')
                EOT;

                try {
                    // $response = Http::withHeaders([
                    //     'Content-Type' => 'application/json',
                    //     'Authorization' => 'Basic aXN3aW0uY28uaWw6MWQzOGI2ODYtODA1OC00NDcxLWFkYjMtZWQzNDM3MDE3Njhl',
                    // ])->post('https://capi.inforu.co.il/api/v2/SMS/SendSms', [
                    //     "Data" => [
                    //         "Message" => $message,
                    //         "Recipients" => [
                    //             [
                    //                 "Phone" => "0542165091"
                    //             ]
                    //         ],
                    //         "Settings" => [
                    //             "Sender" => "Ransas"
                    //         ]
                    //     ]
                    // ]);
                } catch (\Throwable $th) {
                    //throw $th;
                }


                return redirect()->back()->with('success', "Event added");
            }
        }



        public function checkAvailability(Request $request)
        {
            $parent_id = $request->input('parent_id');
            $startDate = date('Y-m-d', strtotime($request->input('startDate')));
            $startTime = $request->input('startTime');
            $endDate = date('Y-m-d', strtotime($request->input('endDate')));
            $endTime = $request->input('endTime');

            $starttime = date('H:i:s', strtotime($startTime));
            $endtime = date('H:i:s', strtotime($endTime));
            // dd($starttime,$endtime,$startDate,$endDate);

            // Check the database for conflicting events
            $conflictingEvents = DB::table('events')->where('pool_id',Auth::user()->id)
            ->where(function ($query) use ($startDate, $starttime, $endDate, $endtime) {
                $query->where(function ($query) use ($startDate, $starttime, $endDate, $endtime) {
                    $query->where('start_date', '<=', $endDate)
                        ->where('end_date', '>=', $startDate)
                        ->where('start_time', '<', $endtime)
                        ->where('end_time', '>', $starttime);
                })
                ->orWhere(function ($query) use ($startDate, $starttime, $endDate, $endtime) {
                    $query->where('start_date', '=', $startDate)
                        ->where('start_time', '<', $endtime)
                        ->where('end_time', '>', $starttime);
                });
            })
            ->where(function ($query) use ($parent_id) {
                if($parent_id != "0") {
                    $query->where('id', '!=',$parent_id);
                }
            })
            ->count();

            // dd($conflictingEvents);

            $available = $conflictingEvents == 0;

            return response()->json(['available' => $available]);
        }


}
