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
    public function messageView(Request $request)
    {
        $template = DB::table('message_template')->where('id',@$request['temp'])->first();
        return view('settings.messageTemplate',compact("template"));
    }

    public function saveTemplate(Request $request) {
        $request->validate([
            'name' => ['required'],
            'content' => ['required'],
        ]);
        $template_id = $request->input('template_id');
        if(isset($template_id)){
            DB::table('message_template')
            ->where('id', $template_id)
            ->update([
                'subject' => $request->name,
                'content' => $request->content,
                'status' => $request->status,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->back()->with('success','התבנית עודכנה בהצלחה');
        }
        return redirect()->back()->with('error','התבנית לא נמצאה');
    }

}
