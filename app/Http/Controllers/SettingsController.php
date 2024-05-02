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
        $pool_id = @$request->input('pool_id');
        $template = "";
        if (isset($request['temp']) && isset($request['pool_id'])) {
            $template = DB::table('message_template')->where('template', @$request['temp'])->where('pool_id',@$request['pool_id'])->first();
        }
        return view('settings.messageTemplate', compact("template"));
    }

    public function saveTemplate(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'content' => ['required'],
        ], [
            'name.required' => 'שדה השם חובה.',
            'content.required' => 'שדה התוכן נדרש.',
        ]);

        $template_id = $request->input('template_id');
        $pool_id = $request->input('pool_id');
        if (isset($template_id)) {
            DB::table('message_template')
                ->where('id', $template_id)
                ->update([
                    'subject' => $request->name,
                    'content' => $request->content,
                    'status' => $request->status,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            return redirect()->back()->with('success', 'התבנית עודכנה בהצלחה');
        }
        return redirect()->back()->with('error', 'התבנית לא נמצאה');
    }
    public function savePoolTemplate(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'content' => ['required'],
        ], [
            'name.required' => 'שדה השם חובה.',
            'content.required' => 'שדה התוכן נדרש.',
        ]);

        $template_id = $request->input('template_id');
        $pool_id = $request->input('pool_id');
        if (isset($template_id) && isset($pool_id)) {
            $template = DB::table('message_template')->where('pool_id', $pool_id)->where('template',$template_id)->first();
            if ($template) {
                DB::table('message_template')
                    ->where('pool_id', $pool_id)
                    ->where('template',$template_id)
                    ->update([
                        'subject' => $request->name,
                        'content' => $request->content,
                        'status' => $request->status,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            } else {
                DB::table('message_template')
                    ->insert([
                        'pool_id' => $pool_id,
                        'template' => $template_id,
                        'subject' => $request->name,
                        'content' => $request->content,
                        'status' => $request->status
                    ]);
            }
            return redirect()->back()->with('success', 'התבנית עודכנה בהצלחה');
        }
        return redirect()->back()->with('error', 'התבנית לא נמצאה');
    }

    public function favicon(){
        return view('settings.favIcon');
    }

    public function saveFavIcon(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required'
        ], [
            'file.required' => 'נא להעלות קובץ.'
        ]);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('uploads'), $filePath);
        }
        $favIcon = DB::table('fav_icon')->first();
        // dd($favIcon);
        if ($favIcon) {
            DB::table('fav_icon')->where('id', $favIcon->id)->update([
                'image' => $filePath
            ]);
            return redirect()->back()->with('success', 'התמונה עודכנה');
        } else {
            DB::table('fav_icon')->insert([
                'id' => 1,
                'image' => $filePath
            ]);
            return redirect()->back()->with('success', 'נוספה תמונה');
        }
        return redirect()->back()->with('error', 'משהו השתבש. אנא נסה שוב');
    }

    public function deleteFavIcon()
    {
        $favIcon = DB::table('fav_icon')->first();
        if ($favIcon) {
            DB::table('fav_icon')->where('id', $favIcon->id)->update([
                'image' => null
            ]);
        }
        return redirect()->back()->with('success', 'התמונה נמחקה');
    }
}
