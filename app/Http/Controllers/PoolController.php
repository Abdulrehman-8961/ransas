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
        $users = DB::table('users')
        ->where('role','Pool')
        ->where(function ($query) use ($search) {
            if(!empty($search)) {
                $query->where('name', 'LIKE', '%'.$search.'%')
                ->orWhere('email', 'LIKE', '%'.$search.'%')
                ->orWhere('role', 'LIKE', '%'.$search.'%')
                ->orWhere('phone', 'LIKE', '%'.$search.'%')
                ->orWhere('permission', 'LIKE', '%'.$search.'%');
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
    public function save(Request $request)
    {
        $validated = $request->validate([
            "name" => 'required',
            "email" => 'required|email|unique:users',
            "password" => 'required|min:6',
            "confirm_password" => 'required|same:password'
        ]);
        if($validated) {
            $insertId = DB::table('users')->insertGetId([
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                "phone" => $request->input('phone'),
                "password" => Hash::make($request->input('password')),
                "role" => 'Pool'
            ]);
            $start_time = date('H:i:s', strtotime($request->input('start_time')));
            $end_time = date('H:i:s', strtotime($request->input('end_time')));

            $data = $request->input('payment_options');
            $payment_options = implode(', ', $data);

            DB::table('pool')
            ->insert([
                'user_id' => $insertId,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'payments' => $payment_options,
                'messages' => $request->sms
            ]);
            return redirect()->back()->with('success', "Pool added");
        }
    }
    public function edit($id)
    {
        $user = DB::table('users')
        ->where('id', $id)
        ->first();
        $pool_data = DB::table('pool')->where('user_id', $id)->first();
            return view("pool.edit", compact("user","pool_data"));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "name" => 'required',
            "email" => [
                "required",
                "email",
                Rule::unique('users', 'email')->ignore($id)
            ]
        ]);
        if($validated) {
            DB::table('users')->where('id', $id)->update([
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                "phone" => $request->input('phone'),
                "updated_at" => date("Y-m-d H:i:s")
            ]);

            $start_time = date('H:i:s', strtotime($request->input('start_time')));
            $end_time = date('H:i:s', strtotime($request->input('end_time')));

            $data = $request->input('payment_options');
            $payment_options = implode(', ', $data);

            DB::table('pool')->where('user_id', $id)
            ->update([
                'start_time' => $start_time,
                'end_time' => $end_time,
                'payments' => $payment_options,
                'messages' => $request->sms
            ]);

            return redirect()->back()->with('success', 'Pool Profile updated');
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
            return redirect()->back()->with('success', 'Pool password updated');
    }
    public function delete($id)
    {
        DB::table('users')->where('role', '!=', 'Amdin')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Pool deleted');
    }

    public function loginToPool($id){
            $user = user::find($id);
            if($user) {
                session(['admin' => Auth::user()->id]);
                Auth::login($user);
                return redirect('/Home')->with('success','Loged in as '.$user->role);
            } else {
                return redirect()->back()->with('error','Something went wrong');
            }
    }
    public function loginToAdmin($id){
            $user = user::find($id);
            if($user) {
                Session::forget('admin');
                Auth::login($user);
                return redirect('/Home')->with('success','Loged in as '.$user->role);
            } else {
                return redirect()->back()->with('error','Something went wrong');
            }
    }
}
