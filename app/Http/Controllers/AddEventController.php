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
            $request->validate([
                "pool_select" => 'required',
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
            if (@$request->input('repeat')) {
                $request->validate([
                    'repeat_cycle' => 'required',
                    'repeat_count' => 'required',
                ]);
            }
            $startdate = date('Y-m-d', strtotime($request->input('start_date')));
            $enddate = date('Y-m-d', strtotime($request->input('end_date')));


            $starttime = date('H:i:s', strtotime($request->input('start_time')));
            $endtime = date('H:i:s', strtotime($request->input('end_time')));
            if ($startdate >= date('Y-m-d')) {
                $pool = DB::table('pool')->where('id',$request->input('pool_select'))->first();

                $dayOfWeek = date('l', strtotime($startdate));
                $dayOfWeekend = date('l', strtotime($endtime));

                $availableDays = explode(', ', $pool->availble_days);
                $availableDays = array_filter($availableDays);

                if(in_array($dayOfWeek,$availableDays) && in_array($dayOfWeekend,$availableDays)){
                    $save = DB::table('events')->insert([
                         "pool_id" => $request->input('pool_select'),
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
                     if (@$request->input('repeat')) {
                         $data = [];
                         $newStartDate = $startdate;
                         $newEndDate = $enddate;
                         $repeat_cycle = $request->input('repeat_cycle');
                         $repeat_count = $request->input('repeat_count');

                         for($i = 1 ; $i <= $repeat_count ; $i++){
                             $dayOfWeek = date('l', strtotime($newStartDate));
                             $dayOfWeekend = date('l', strtotime($newEndDate));
                             if(in_array($dayOfWeek,$availableDays) && in_array($dayOfWeekend,$availableDays)){
                             if ($repeat_cycle == "Monthly") {
                                 $newStartDate = date("Y-m-d", strtotime($newStartDate . " +30 days"));
                                 $newEndDate = date("Y-m-d", strtotime($newEndDate . " +30 days"));
                             } elseif ($repeat_cycle == "Weekly") {
                                 $newStartDate = date("Y-m-d", strtotime($newStartDate . " +7 days"));
                                 $newEndDate = date("Y-m-d", strtotime($newEndDate . " +7 days"));
                             } else {
                                 $newStartDate = date("Y-m-d", strtotime($newStartDate . " +1 days"));
                                 $newEndDate = date("Y-m-d", strtotime($newEndDate . " +1 days"));
                             }
                             $data[] = [
                                 "pool_id" => $request->input('pool_select'),
                                 "booking_type" => $request->input('type'),
                                 "customer_name" => $request->input('customer_name'),
                                 "start_date" => $newStartDate,
                                 "start_time" => $starttime,
                                 "end_date" => $newEndDate,
                                 "end_time" => $endtime,
                                 "customer_email" => $request->input('customer_email'),
                                 "customer_phone" => $request->input('customer_phone'),
                                 "total_payment" => $request->input('total_payment'),
                                 "payment_method" => $request->input('payment_method'),
                                 "payment_status" => $request->input('payment_status'),
                                 "color" => $request->input('event_level'),
                                 "percentage_value" => $request->input('percentage_value'),
                                 "created_by" => Auth::user()->id
                             ];
                         } else {
                             break;
                         }
                         }
                         DB::table('events')->insert($data);
                     }
                     if($save){
                         DB::table('log_history')->insert([
                             'user_id' => Auth::user()->id,
                             'description' => "Added New Event ".$request->input('type')." For Client: ".ucFirst($request->input('customer_name'))."",
                             'page' => 'Add Event'
                         ]);
                     }
                     $start_date = date('d.m.Y', strtotime($request->input('start_date')));
                     $end_date = date('d.m.Y', strtotime($request->input('end_date')));

                     $message_template = DB::table('message_template')->where('id',2)->first();
                     if ($message_template->status == "Send") {
                         $replacements = [
                             '{customer_name}' => $request->input('customer_name'),
                             '{date}' => $start_date.' - '.$end_date,
                             '{time}' => date("h:i a",strtotime($starttime)).' - '.date("h:i a",strtotime($endtime)),
                             '{payment_status}' => $request->input('payment_status'),
                             '{total_amount}' => $request->input('total_payment'),
                             '{booking_method}' => $request->input('payment_method'),
                             '{booking_type}' => $request->input('type'),
                           ];
                         $templateContent = $message_template->content;
                         $message = str_replace(array_keys($replacements), array_values($replacements), $templateContent);

                         // $message = <<<EOT
                         // New event added:
                         // Type: {$request->input('type')}.
                         // Customer: {$request->input('customer_name')}
                         // Date: $start_date - $end_date
                         // Time: $request->input('start_time') - $request->input('end_time')
                         // EOT;

                         try {
                            //  $response = Http::withHeaders([
                            //      'Content-Type' => 'application/json',
                            //      'Authorization' => 'Basic aXN3aW0uY28uaWw6MWQzOGI2ODYtODA1OC00NDcxLWFkYjMtZWQzNDM3MDE3Njhl',
                            //  ])->post('https://capi.inforu.co.il/api/v2/SMS/SendSms', [
                            //      "Data" => [
                            //          "Message" => $message,
                            //          "Recipients" => [
                            //              [
                            //                  "Phone" => "0542165091"
                            //              ]
                            //          ],
                            //          "Settings" => [
                            //              "Sender" => "Ransas"
                            //          ]
                            //      ]
                            //  ]);
                         } catch (\Throwable $th) {
                             //throw $th;
                         }
                     }

                }

                 return redirect()->back()->with('success', "Event added");
            }
            return redirect()->back()->with('error', "Previous date not allowed");
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

        public function getPaymentOptions(Request $request){
            $poolID = $request->input('pool_id');
            $pool = DB::table('pool')->where('id',$poolID)->first();
            if ($pool) {
                $options = explode(', ', $pool->payments);
                $html = '<option value="">Select Payment Method</option>';
                foreach ($options as $option) {
                    $html .= '<option value="' . $option . '">' . $option . '</option>';
                }

                return response()->json(['success' => true, 'options' => $html]);
            } else {
                return response()->json(['success' => false, 'message' => 'Pool not found']);
            }
        }

        public function getAvailableDays(Request $request) {
            $poolID = $request->input('pool_id');
            $pool = DB::table('pool')->where('id', $poolID)->first();

            if ($pool) {
                $availableDays = explode(', ', $pool->availble_days);
                $availableDays = array_filter($availableDays);
                $allDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

                // Find the days to be disabled
                $disabledDays = array_diff($allDays, $availableDays);

                // Convert textual days to numeric days (0-6)
                $disabledDaysNumeric = [];
                foreach ($disabledDays as $day) {
                    $disabledDaysNumeric[] = date('w', strtotime($day));
                }

                return response()->json(['success' => true, 'disabledDays' => $disabledDaysNumeric]);
            } else {
                return response()->json(['success' => false, 'message' => 'Pool not found']);
            }
        }
        public function getAvailableTimeSlots(Request $request) {
            // Get the selected date from the AJAX request
            $selectedDate = $request->input('selected_date');

            // Determine the day of the week (e.g., Monday, Tuesday, etc.) for the selected date
            $dayOfWeek = date('l', strtotime($selectedDate));

            // Fetch the start and end times for the selected day of the week
            $dayColumns = strtolower(substr($dayOfWeek, 0, 3)); // Get first three letters in lowercase
            $startTimeColumn = $dayColumns . '_start_time';
            $endTimeColumn = $dayColumns . '_end_time';

            $timeSlot = DB::table('pool')
            ->where('availble_days', 'like', '%' . $dayOfWeek . '%')
                            ->first([$startTimeColumn, $endTimeColumn]);

            if (!$timeSlot) {
                return response()->json(['success' => false, 'message' => 'No available time slots for selected day']);
            }

            // Respond with success and available time slot for the selected day
            return response()->json(['success' => true, 'startTime' => $timeSlot->$startTimeColumn, 'endTime' => $timeSlot->$endTimeColumn]);
        }
}
