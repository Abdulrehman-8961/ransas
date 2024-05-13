<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use ZipArchive;

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
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ], [
            'title.required' => 'שדה הכותרת חובה.',
            'description.required' => 'שדה התיאור נדרש.'
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
            'status' => "ממתין",
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
        $validated = $request->validate([
            'description' => 'required'
        ], [
            'description.required' => 'שדה התיאור נדרש.'
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

    public function updateStatus(Request $request, $id)
    {
        DB::table('ticket')->where('id', $id)->update([
            'status' => $request->update_status
        ]);
        return redirect()->back()->with('success', 'השינוי בוצע בהצלחה');
    }

    public function download_files_old($id){
        $fileNamesJson = DB::table('accident_report')->where('id',$id)->first();
        $names = $fileNamesJson->file;
        // Decode the JSON array
        $fileNames = json_decode($names);

        // Create a unique temporary directory to store the zip file
        $tempDirectory = public_path('temp');
        // Check if the directory already exists
        if (!File::exists($tempDirectory)) {
            // Create the directory if it doesn't exist
            File::makeDirectory($tempDirectory);
        }

        // Create a unique zip file in the temporary directory
        $zipFile = public_path('temp/all_files.zip');
        $zip = new ZipArchive;
        $zip->open($zipFile, ZipArchive::CREATE);

        // Add each file to the zip archive
        foreach ($fileNames as $fileName) {
            $filePath = public_path("uploads/{$fileName}");
            $zip->addFile($filePath, $fileName);
        }

        $zip->close();

        // Download the zip file
        return response()->download($zipFile)->deleteFileAfterSend(true);
    }
    public function download_files($id){
        // Fetch file names from the database
        $fileRecords = DB::table('chat_attachments')->where('chat_id', $id)->get();

        // Create a unique temporary directory to store the zip files
        $tempDirectory = public_path('temp');
        if (!File::exists($tempDirectory)) {
            File::makeDirectory($tempDirectory);
        }

        // Create a zip file for each image
        $zip = new ZipArchive;

        foreach ($fileRecords as $fileRecord) {
            $fileName = $fileRecord->file;
            $filePath = public_path("uploads/{$fileName}");

            if (File::exists($filePath)) {
                // Create a unique zip file for each image
                $zipFile = public_path("temp/{$fileName}.zip");

                // Create a new zip archive
                $zip->open($zipFile, ZipArchive::CREATE);

                // Add the image to the zip archive
                $zip->addFile($filePath, $fileName);
                $zip->close();

                // Download the zip file
                return response()->download($zipFile)->deleteFileAfterSend(true);
            }
        }

        // If no file was found, return an error response
        return response()->json(['error' => 'No files found for the given ID'], 404);
    }

}
