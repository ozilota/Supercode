<?php

namespace App\Http\Controllers;

use App\Models\FileModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketDetayController extends Controller
{
    public function addNewAnswer(Request $request)
    {
        $file = null;
        $file_path = null;

        DB::table('ticket')->insert([
            "creator_id" => Auth::id(),
            "ticket_id" => $request->ticket_id,
            "reply" => $request->metin,
        ]);

        if ($request->validate([
            'file.*' => ['nullable', "mimes:jpeg,jpg,png,pdf,xls,word", 'max:65536']])) {
            $file = $request->file;
        }

        if ($request->hasFile('file')) {
            foreach ($request->file as $file) {
                $file_path = $file->store('ticketFile', 'public');
                $new_id = json_decode(json_encode(DB::table('ticket_detail')
                    ->select("id")
                    ->orderByDesc("id")
                    ->first()));

                FileModel::create([
                    "ticket_id" => null,
                    "ticket_detail_id" => $new_id->id,
                    "file" => $file_path,
                ]);
            }
        }
        return back();
    }

}
