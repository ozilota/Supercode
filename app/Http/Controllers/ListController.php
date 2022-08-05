<?php

namespace App\Http\Controllers;

use App\Models\TicketModel;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListController extends Controller
{
    public function index()
    {
        return view('deneme');
    }

    public function getTickets(Request $request)
    {
        if (Auth::id() < 3) {
            $data = DB::table('ticket')
                ->join("users", "users.id", "=", 'ticket.creator_id')
                ->select('users.name', 'ticket.id', 'ticket.title', 'ticket.status', 'ticket.created_at')
                ->orderBy('ticket.created_at', 'desc')
                ->get();
        } else {
            $data = DB::table('ticket')
                ->join("users", "users.id", "=", 'ticket.creator_id')
                ->select('users.name', 'ticket.id', 'ticket.title', 'ticket.status', 'ticket.created_at')
                ->where('ticket.creator_id', '=', Auth::id())
                ->orderBy('ticket.created_at', 'desc')
                ->get();
        }
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.route('ticketDetail', $row->id).'" class="edit btn btn-success btn-sm">Edit</a>
                    <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
