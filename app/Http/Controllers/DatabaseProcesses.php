<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatabaseProcesses extends Controller
{
    public function newTicket(){
        DB::table('ticket')->insert([]);
    }

    public function drop(){}

    public function update(){}

    public function getAllTickets(){
        $veri = DB::table('bilgiler')->where("id", 5)->first();
        return $veri;
    }

}
