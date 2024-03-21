<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use Redirect;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');

    }

    public function payment(Request $request) {
        $amount = $request->input('amount');
        $customer_name = $request->input('customer_name');
        $customer_email = $request->input('customer_email');
        $customer_phone = $request->input('customer_phone');
        $book_type = $request->input('book_type');
        $book_id = $request->input('book_id');

        $base_url = "http://huzmark.com/ransas";

        $response = Http::withHeaders([
            'accept' => 'text/plain',
            'Content-Type' => 'application/json-patch+json',
        ])->post('https://api.sumit.co.il/billing/payments/beginredirect/', [
            "Customer" => [
                "Name" => $customer_name,
                // Add other customer details if needed
            ],
            "Items" => [
                [
                    "Item" => [
                        "Name" => $book_type,
                    ],
                    "Quantity" => 1,
                    "UnitPrice" => $amount,
                ]
            ],
            "VATIncluded" => true,
            "RedirectURL" => $base_url."/payment_success?book_id=".$book_id,
            "Credentials" => [
                "CompanyID" => 330173225,
                "APIKey" => "MAEGtAtdLD4hLBvfT8sKqGGCuvuxXWzB2cfoz52UmhDMcXqGdy",
            ],
        ]);

        // Handle the response
        $responseData = $response->json();
        // dd($responseData);
        if (isset($responseData['Data']['RedirectURL'])) {
            return redirect($responseData['Data']['RedirectURL']);
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function successFunction(Request $request){
        $eventId = $request['book_id'];
        $customerId = $request['OG-CustomerID'];
        $paymentId = $request['OG-PaymentID'];
        DB::table('events')->where('id',$eventId)->update([
            // 'payment_status' => 'Paid',
            'sumit_payment_id' => $paymentId,
            'sumit_customr_id' => $customerId,
        ]);
        return redirect()->back()->with('success', 'Payment Successfull.');

    }
}
