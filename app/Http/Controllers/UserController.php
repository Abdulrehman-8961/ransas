<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function view(Request $request)
    {
        $search = @$request->get('search');
        $users = DB::table('users')
            ->where(function ($query) {
                if (Auth::user()->role == "Admin") {
                    $query->wherein('role', ['Staff', 'Admin'])
                        ->where('id', '!=', Auth::user()->id);
                } elseif (Auth::user()->role == "Pool") {
                    $query->where('pool_id', Auth::user()->id);
                }
            })
            ->where(function ($query) use ($search) {
                if (!empty($search)) {
                    $query->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%')
                        ->orWhere('role', 'LIKE', '%' . $search . '%')
                        ->orWhere('phone', 'LIKE', '%' . $search . '%')
                        ->orWhere('permission', 'LIKE', '%' . $search . '%');
                }
            })
            ->orderBy('id', 'desc')->paginate(20);
        $users->appends([
            "search" => $search,
        ]);

        return view("user.view", compact("users"));
    }
    public function add()
    {
        return view("user.add");
    }
    public function save(Request $request)
    {
        $pool_ids = '';
        $validated = $request->validate([
            "name" => 'required',
            "permission" => 'required',
            "email" => 'required|email|unique:users',
            "password" => 'required|min:6',
            "confirm_password" => 'required|same:password'
        ], [
            'name.required' => 'שדה השם חובה.',
            'permission.required' => 'שדה ההרשאה נדרש.',
            'email.required' => 'שדה הדוא"ל נדרש.',
            'email.email' => 'נא לספק כתובת דוא"ל חוקית.',
            'email.unique' => 'המייל כבר נלקח.',
            'password.required' => 'שדה הסיסמה נדרש.',
            'password.min' => 'הסיסמה חייבת להיות באורך של לפחות :min תווים.',
            'confirm_password.required' => 'שדה אישור הסיסמה נדרש.',
            'confirm_password.same' => 'סיסמת האישור חייבת להתאים לשדה הסיסמה.'
        ]);

        if ($request->input('role') == "Staff") {
            $validated = $request->validate([
                "pool" => 'required',
            ], [
                'pool.required' => 'שדה הבריכה נדרש.',
            ]);
        }
        if (@$request->input('pool')) {
            $data = $request->input('pool');
            $pool_ids = implode(', ', $data);
        }
        DB::table('users')->insert([
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            "phone" => $request->input('phone'),
            "permission" => $request->input('permission'),
            "pool_id" => $pool_ids,
            "password" => Hash::make($request->input('password')),
            "role" => $request->input('role')
        ]);
        return redirect()->back()->with('success', "משתמש נוסף");
    }
    public function edit($id)
    {
        $user = DB::table('users')
            ->where('id', $id)
            ->first();
        return view("user.edit", compact("user"));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "name" => 'required',
            "email" => [
                "required",
                "email",
                Rule::unique('users', 'email')->ignore(Auth::user()->id),
            ]
        ], [
            'name.required' => 'שדה השם חובה.',
            'email.required' => 'שדה הדוא"ל נדרש.',
            'email.email' => 'נא לספק כתובת דוא"ל חוקית.',
            'email.unique' => 'המייל כבר נלקח.',
        ]);
        if ($request->input('role') == "Staff") {
            $request->validate([
                "pool" => 'required',
            ], [
                'pool.required' => 'שדה הבריכה נדרש.',
            ]);
        }
        if (@$request->input('pool')) {
            $data = $request->input('pool');
            $pool_ids = implode(', ', $data);
        }
        if ($validated) {
            DB::table('users')->where('id', $id)->update([
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                "phone" => $request->input('phone'),
                "pool_id" => $pool_ids,
                "permission" => $request->input('permission'),
                "role" => $request->input('role'),
                "updated_at" => date("Y-m-d H:i:s")
            ]);
            return redirect()->back()->with('success', 'פרופיל משתמש עודכן');
        }
    }
    public function update_password(Request $request, $id)
    {
        $validated = $request->validate([
            "password" => 'required|min:6',
            "confirm_password" => 'required|same:password',
        ], [
            'password.required' => 'שדה הסיסמה נדרש.',
            'password.min' => 'הסיסמה חייבת להיות באורך של לפחות :min תווים.',
            'confirm_password.required' => 'שדה אישור הסיסמה נדרש.',
            'confirm_password.same' => 'סיסמת האישור חייבת להתאים לשדה הסיסמה.',
        ]);
        if ($validated) {
            DB::table('users')->where('id', $id)->update([
                "password" => Hash::make($request->input('password')),
                "updated_at" => date("Y-m-d H:i:s")
            ]);
            return redirect()->back()->with('success', 'סיסמת המשתמש עודכנה');
        }
    }
    public function delete($id)
    {
        DB::table('users')->where('role', '!=', 'Amdin')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'המשתמש נמחק');
    }
}
