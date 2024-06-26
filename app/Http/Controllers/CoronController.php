<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class CoronController extends Controller
{
    public function smsReminder()
    {
        $currentDateTime = Carbon::now();
        $next24Hours = $currentDateTime->copy()->addHours(24)->toDateTimeString();

        $events = DB::table('events')
            ->where(DB::raw("CONCAT(start_date, ' ', start_time)"), '>=', $currentDateTime->toDateTimeString())
            ->where(DB::raw("CONCAT(start_date, ' ', start_time)"), '<=', $next24Hours)
            ->where('reminder', 0)
            ->get();
        // if ($message_template) {
        //     if ($message_template->status == "Send") {
        //     }
        // }
        foreach ($events as $row) {
            $message_template = DB::table('message_template')->where('template', 1)->where('pool_id', @$row->pool_id)->first();
            if ($message_template) {
                if ($message_template->status == "Send") {
                    $pool_data = DB::table('pool')->where('id', @$row->pool_id)->first();
                    $replacements = [
                        '{pool_name}' => $pool_data->name,
                        '{customer_name}' => $row->stylist_name,
                        '{date}' => date("d.m.Y", strtotime($row->start_date)) . ' - ' . date("d.m.Y", strtotime($row->end_date)),
                        '{time}' => date("h:i a", strtotime($row->start_time)) . ' - ' . date("h:i a", strtotime($row->end_time)),
                        '{payment_status}' => $row->payment_status,
                        '{total_amount}' => $row->total_payment,
                        '{booking_method}' => $row->payment_method,
                        '{booking_type}' => $row->booking_type,
                    ];
                    $templateContent = $message_template->content;
                    $message = str_replace(array_keys($replacements), array_values($replacements), $templateContent);
                    $phone_number = $row->customer_phone;
                    try {
                        $response = Http::withHeaders([
                            'Content-Type' => 'application/json',
                            'Authorization' => 'Basic aXN3aW0uY28uaWw6MWQzOGI2ODYtODA1OC00NDcxLWFkYjMtZWQzNDM3MDE3Njhl',
                        ])->post('https://capi.inforu.co.il/api/v2/SMS/SendSms', [
                            "Data" => [
                                "Message" => $message,
                                "Recipients" => [
                                    [
                                        "Phone" => $phone_number
                                    ]
                                ],
                                "Settings" => [
                                    "Sender" => "Ransas"
                                ]
                            ]
                        ]);
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                }
            }
            DB::table('events')->where('id', $row->id)->update([
                'reminder' => 1
            ]);
        }
    }

    public function checkPaymentStatus()
    {
        $events = DB::table('events')->where('payment_method', 'Card')->where('sumit_payment_id', '!=', 'null')->get();
        // dd($events);

        foreach ($events as $row) {
            $response = Http::post('https://api.sumit.co.il/billing/payments/get/', [
                'Credentials' => [
                    'CompanyID' => 330173225,
                    'APIKey' => 'MAEGtAtdLD4hLBvfT8sKqGGCuvuxXWzB2cfoz52UmhDMcXqGdy'
                ],
                'PaymentID' => $row->sumit_payment_id
            ]);

            $responseData = $response->json();
            if ($responseData['Data']['Payment']['Status'] == "000" && $responseData['Data']['Payment']['ValidPayment'] == true) {
                DB::table('events')->where('id', $row->id)->update([
                    'payment_status' => 'Paid',
                ]);
            }
        }
    }
}
