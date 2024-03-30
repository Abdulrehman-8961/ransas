<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Session;

class PoolController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function view(Request $request)
    {
        $search = @$request->get('search');
        $users = DB::table('pool')
        ->where('is_deleted',0)
        ->where(function ($query) use ($search) {
            if(!empty($search)) {
                $query->where('name', 'LIKE', '%'.$search.'%')
                ->orWhere('email', 'LIKE', '%'.$search.'%')
                ->orWhere('phone', 'LIKE', '%'.$search.'%');
            }
        })
        ->orderBy('id', 'desc')->paginate(20);
        $users->appends([
          "search" => $search,
        ]);

        return view("pool.view", compact("users"));
    }
    public function add()
    {
        return view("pool.add");
    }

    public function dateFormat($date){
        if ($date) {
            $value = date('H:i:s', strtotime($date));
            return $value;
        }
        return null;
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            "name" => 'required|unique:pool',
            "email" => 'required|email',
            "payment_options" => 'required',
            "sms" => 'required',
        ]);
        if($validated) {

            $data = $request->input('payment_options');
            $payment_options = implode(', ', $data);

            $insert_fields = [
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                "phone" => $request->input('phone'),
                'payments' => $payment_options,
                "account_no" => $request->input('account_no'),
                'messages' => $request->sms,
                'availble_days' => ['monday' => $request->input('monday'),
                'tuesday' => $request->input('tuesday'),
                'wednesday' => $request->input('wednesday'),
                'thursday' => $request->input('thursday'),
                'friday' => $request->input('friday'),
                'saturday' => $request->input('saturday'),
                'sunday' => $request->input('sunday')],
                'mon_start_time'=> $this->dateFormat($request->input('mon_start_time')),
                'mon_end_time'=> $this->dateFormat($request->input('mon_end_time')),
                'tue_start_time'=> $this->dateFormat($request->input('tue_start_time')),
                'tue_end_time'=> $this->dateFormat($request->input('tue_end_time')),
                'wed_start_time'=> $this->dateFormat($request->input('wed_start_time')),
                'wed_end_time'=> $this->dateFormat($request->input('wed_end_time')),
                'thu_start_time'=> $this->dateFormat($request->input('thu_start_time')),
                'thu_end_time'=> $this->dateFormat($request->input('thu_end_time')),
                'fri_start_time'=> $this->dateFormat($request->input('fri_start_time')),
                'fri_end_time'=> $this->dateFormat($request->input('fri_end_time')),
                'sat_start_time'=> $this->dateFormat($request->input('sat_start_time')),
                'sun_start_time'=> $this->dateFormat($request->input('sun_start_time')),
                'sun_end_time'=> $this->dateFormat($request->input('sun_end_time')),
                'sat_end_time'=> $this->dateFormat($request->input('sat_end_time')),
            ];
            if (isset($insert_fields['availble_days'])) {
                $insert_fields['availble_days'] = implode(', ', $insert_fields['availble_days']);
            }

                // dd($insert_fields);
            DB::table('pool')->insert($insert_fields);
            return redirect()->back()->with('success', "נוספה בריכה");
        }
    }
    public function edit($id)
    {
        $pool_data = DB::table('pool')->where('id', $id)->first();
        return view("pool.edit", compact("pool_data"));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "name" => ['required',Rule::unique('pool', 'name')->ignore($id)],
        ]);
        if($validated) {
            // DB::table('users')->where('id', $id)->update([
            //     "name" => $request->input('name'),
            //     "email" => $request->input('email'),
            //     "phone" => $request->input('phone'),
            //     "updated_at" => date("Y-m-d H:i:s")
            // ]);

            $start_time = date('H:i:s', strtotime($request->input('start_time')));
            $end_time = date('H:i:s', strtotime($request->input('end_time')));

            $data = $request->input('payment_options');
            $payment_options = implode(', ', $data);

            $insert_fields = [
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                "phone" => $request->input('phone'),
                'payments' => $payment_options,
                "account_no" => $request->input('account_no'),
                'messages' => $request->sms,
                'availble_days' => ['monday' => $request->input('monday'),
                'tuesday' => $request->input('tuesday'),
                'wednesday' => $request->input('wednesday'),
                'thursday' => $request->input('thursday'),
                'friday' => $request->input('friday'),
                'saturday' => $request->input('saturday'),
                'sunday' => $request->input('sunday')],
                'mon_start_time'=> $this->dateFormat($request->input('mon_start_time')),
                'mon_end_time'=> $this->dateFormat($request->input('mon_end_time')),
                'tue_start_time'=> $this->dateFormat($request->input('tue_start_time')),
                'tue_end_time'=> $this->dateFormat($request->input('tue_end_time')),
                'wed_start_time'=> $this->dateFormat($request->input('wed_start_time')),
                'wed_end_time'=> $this->dateFormat($request->input('wed_end_time')),
                'thu_start_time'=> $this->dateFormat($request->input('thu_start_time')),
                'thu_end_time'=> $this->dateFormat($request->input('thu_end_time')),
                'fri_start_time'=> $this->dateFormat($request->input('fri_start_time')),
                'fri_end_time'=> $this->dateFormat($request->input('fri_end_time')),
                'sat_start_time'=> $this->dateFormat($request->input('sat_start_time')),
                'sun_start_time'=> $this->dateFormat($request->input('sun_start_time')),
                'sun_end_time'=> $this->dateFormat($request->input('sun_end_time')),
                'sat_end_time'=> $this->dateFormat($request->input('sat_end_time')),
                "updated_at" => date("Y-m-d H:i:s")
            ];
            if (isset($insert_fields['availble_days'])) {
                $insert_fields['availble_days'] = implode(', ', $insert_fields['availble_days']);
            }
            DB::table('pool')->where('id', $id)
            ->update($insert_fields);

            return redirect()->back()->with('success', 'פרופיל הבריכה עודכן');
        }
    }
    public function update_password(Request $request, $id)
    {
        $request->validate([
            "password" => 'required|min:6',
            "confirm_password" => 'required|same:password',
        ]);
            DB::table('users')->where('id', $id)->update([
                "password" => Hash::make($request->input('password')),
                "updated_at" => date("Y-m-d H:i:s")
            ]);
            return redirect()->back()->with('success', 'סיסמת הבריכה עודכנה');
    }
    public function delete($id)
    {
        DB::table('pool')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'הבריכה נמחקה');
    }

    public function loginToPool($id){
            $user = user::find($id);
            if($user) {
                session(['admin' => Auth::user()->id]);
                Auth::login($user);
                return redirect('/Home')->with('success','מחובר כמשתמש');
            } else {
                return redirect()->back()->with('error','משהו השתבש');
            }
    }
    public function loginToAdmin($id){
            $user = user::find($id);
            if($user) {
                Session::forget('admin');
                Auth::login($user);
                return redirect('/Home')->with('success','מחובר כמנהל');
            } else {
                return redirect()->back()->with('error','משהו השתבש');
            }
    }
}
