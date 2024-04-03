<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function view()
    {
        return view("support.support");
    }

    public function newTicket()
    {
        return view("support.add");
    }

    public function saveTicket(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $ticket = DB::table('ticket')->latest('created_at')->first();
        if ($ticket) {
            $last_ticket = $ticket->ticket_no;
            $ticket_no = $last_ticket + 1;
        } else {
            $ticket_no = '1000';
        }

        $last_id = DB::table('ticket')->insertGetId([
            'user_id' => Auth::user()->id,
            'ticket_no' => $ticket_no,
            'title' => $request->input('title'),
        ]);

        if ($last_id) {
            DB::table('chat')->insert([
                'ticket_id' => $last_id,
                'ticket_no' => $ticket_no,
                'from_id' => Auth::user()->id,
                'description' => $request->input('description'),
            ]);
        }
        return redirect()->back()->with('success', 'Ticket Created');
    }

    public function ticket($id)
    {
        $ticket = DB::table('ticket')->where('id', $id)->first();
        return view('support.chat', compact('ticket'));
    }

    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'description' => 'required'
        ]);
        $ticket = DB::table('ticket')->where('id', $id)->first();
        $last_id = DB::table('chat')->insertGetId([
            'ticket_no' => $ticket->ticket_no,
            'ticket_id' => $ticket->id,
            'from_id' => Auth::user()->id,
            'description' => $request->input('description'),
        ]);

        if ($request->hasFile('file')) {
            if ($request->hasfile('file')) {
                foreach ($request->file('file') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move(public_path('uploads'), $name);
                    DB::table('chat_attachments')->insert([
                        'chat_id' => $last_id,
                        'file' => $name,
                    ]);
                }
            }
        }
        return redirect()->back()->with('success', 'Message sent');
    }
}
