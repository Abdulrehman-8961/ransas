<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use Redirect;
use DB;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function messageView()
    {
        $template = DB::table('message_template')->where('id',1)->first();
        return view('settings.messageTemplate',compact("template"));
    }

    public function saveTemplate(Request $request) {
        $request->validate([
            'name' => ['required'],
            'content' => ['required'],
        ]);
        DB::table('message_template')
        ->where('id', 1)
        ->update([
            'subject' => $request->name,
            'content' => $request->content,
            'status' => $request->status,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success','Template Updated successfully');
    }

}
