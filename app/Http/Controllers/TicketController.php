<?php

namespace App\Http\Controllers;

use App\Models\FileModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TicketModel;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function openTicket(Request $request)
    {
        $olusturan = Auth::user()->id;
        $title = $request->konu;
        $metin = $request->metin;
        $file = null;

        if ($request->validate([
            'file.*' => ['nullable', "mimes:jpeg,jpg,png,pdf,xls,word", 'max:65536']])) {
            $file = $request->file;
        }


        $file_path = null;
        if ($request->hasFile('file')) {
            foreach ($request->file as $file){
                $file_path = $file->store('ticketFile', 'public');
                $result=json_decode(json_encode(DB::table('ticket')->select("id")->orderByDesc("id")->first()));
                FileModel::create([
                    "ticket_id"=>$result->id,
                    "ticket_detail_id"=>null,
                    "file"=>$file_path,
                ]);
            }
        }

        TicketModel::create([
            "creator_id" => $olusturan,
            "title" => $title,
            "content" => $metin,
            "file" => $file_path,
            'created_at' => Carbon::now(+3),
        ]);

        $name_json = DB::table('users')->select('name')->where('id', '=', Auth::user()->id)->get();
        $name = json_decode(json_encode($name_json));

        //MailController::send($name[0]->name, $title);

        return redirect('home');
    }

    public function getAllTickets(Request $request)
    {
        if (Auth::user()->is_admin) {
            $data = DB::table('ticket')
                ->join("users", "users.id", "=", 'ticket.creator_id')
                ->join('status', 'status.id', '=', 'ticket.status')
                ->select('users.name', 'ticket.id', 'ticket.title', 'ticket.created_at', 'status.name as status'
                    , 'users.job_definition', 'users.department_name', 'users.school_name')
                ->orderBy('ticket.created_at', 'desc')
                ->get();
        } else {
            $data = DB::table('ticket')
                ->join("users", "users.id", "=", 'ticket.creator_id')
                ->join('status', 'status.id', '=', 'ticket.status')
                ->select('users.name', 'ticket.id', 'ticket.title', 'ticket.status', 'ticket.created_at',
                    'status.name as status', 'users.job_definition', 'users.department_name', 'users.school_name')
                ->where('ticket.creator_id', '=', Auth::user()->id)
                ->orderBy('ticket.created_at', 'desc')
                ->get();
        }
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('ticketDetail', $row->id) . '" class="edit btn btn-success
btn-sm">Edit</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getTicketDetails($id)
    {
        $ticketData = DB::table('ticket')
            ->join('users', 'users.id', '=', 'ticket.creator_id')
            ->join('status', 'status.id', '=', 'ticket.status')
            ->select('ticket.id', 'users.name', 'ticket.creator_id', 'ticket.title', 'ticket.content',
                'status.name as status', 'ticket.created_at', 'ticket.file')
            ->where('ticket.id', '=', $id)
            ->get();

        $ticketDetail = DB::table('ticket_detail')
            ->join('users', 'users.id', '=', 'ticket_detail.creator_id')
            ->select('users.name', 'ticket_detail.created_at', 'ticket_detail.reply', 'ticket_detail.creator_id'
                , 'ticket_detail.ticket_id')
            ->where('ticket_detail.ticket_id', '=', $id)
            ->orderByDesc('ticket_detail.created_at')
            ->get();

        $ticketFiles = DB::table('files')
            ->select('file')
            ->where('ticket_id', '=', $id)
            ->get();
        $files = json_decode($ticketFiles);


        $ticketDetailFiles = DB::table('files')
            ->join('ticket_detail', 'ticket_detail.id', '=', 'files.ticket_detail_id')
            ->select('file')
            ->where('files.ticket_detail_id', '=', 'ticket_detail.id')
            ->get();


        $ticketID = json_decode($ticketData)[0]->id;
        $ticketFile = json_decode($ticketData)[0]->file;

        return view('ticketDetay', json_decode(json_encode(['ticketData' => $ticketData,
            'ticketDetail' => $ticketDetail, 'ticketID'=>$ticketID, 'ticketFile'=>$ticketFile, 'ticket_files'=>$files]), true));
    }

    public function updateTicketStatus(Request $request)
    {
        DB::table('ticket')->where("id", '=', $request->ticket_id)->update([
            "status" => $request->status
        ]);

        DB::table('ticket_detail')->insert([
            "creator_id" => Auth::id(),
            "ticket_id" => $request->ticket_id,
            "reply" => $request->metin,
        ]);

        return back();
        //->withInput($request->ticket_id)
    }
}
