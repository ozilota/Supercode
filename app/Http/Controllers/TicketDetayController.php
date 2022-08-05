<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketDetayController extends Controller
{
    public function addNewAnswer(Request $request){
            DB::table('ticket_detail')->insert([
                "creator_id"=>Auth::id(),
                "ticket_id"=>$request->ticket_id,
                "reply"=>$request->metin,
            ]);
            return back();
        }
}
