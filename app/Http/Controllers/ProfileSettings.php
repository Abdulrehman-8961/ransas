<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileSettings extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth"]);
    }
    public function settings()
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        return view("profile.profileSettings", compact("user"));
    }
    public function update_profile(Request $request)
    {
        $validated = $request->validate([
            "name" => 'required',
            "email" => [
                "required",
                "email",
                Rule::unique('users', 'email')->ignore(Auth::user()->id),
            ]
        ]);
        if($validated)
        {
            $insertFields = [
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                "phone" => $request->input('phone'),
            ];
            if ($request->hasFile('file')) {
                $fileName = $request->file('file')->getClientOriginalName();
                $request->file('file')->move(public_path('dist/images/profile'), $fileName);

                $insertFields['image'] = $fileName;
            }
            DB::table('users')->where('id', Auth::user()->id)->update($insertFields);
            return redirect()->back()->with('success', "הפרופיל עודכן");
        }
    }
    public function update_password(Request $request)
    {
        $validated = $request->validate([
            "password" => 'required|min:6',
            "confirm_password" => 'required|same:password',
        ]);
        if($validated) {
            DB::table('users')->where('id', Auth::user()->id)->update([
                "password" => Hash::make($request->input('password')),
            ]);
            return redirect()->back()->with('success', 'הסיסמה עודכנה');
        }
    }
}
