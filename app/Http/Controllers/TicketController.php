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
        $title = $request->title;
        $content = $request->ticket_content;
        $file = null;
        $file_path = null;

        if ($request->validate([
            'file.*' => ['nullable', "mimes:jpeg,jpg,png,pdf,xls,word", 'max:65536']])) {
            $file = $request->file;
        }

        if ($request->hasFile('file')) {
            foreach ($request->file as $file){
                $file_path = $file->store('ticketFile', 'public');
                $result=json_decode(json_encode(DB::table('ticket')->select("id")->orderByDesc("id")->first()));
                FileModel::create([
                    "ticket_id"=>$result->id+1,
                    "file"=>$file_path,
                ]);
            }
        }

        TicketModel::create([
            "creator_id" => $olusturan,
            "title" => $title,
            "content" => $content,
            "parent_id"=>0,
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
                ->select('users.name', 'ticket.id', 'ticket.title', 'ticket.created_at', 'status.name as status'
                    , 'users.job_definition', 'users.department_name', 'users.school_name')
                ->join("users", "users.id", "=", 'ticket.creator_id')
                ->join('status', 'status.id', '=', 'ticket.status')
                ->where('ticket.parent_id', '=', 0)
                ->orderBy('ticket.created_at', 'desc')
                ->get();
        } else {
            $data = DB::table('ticket')
                ->join("users", "users.id", "=", 'ticket.creator_id')
                ->join('status', 'status.id', '=', 'ticket.status')
                ->select('users.name', 'ticket.id', 'ticket.title', 'ticket.status', 'ticket.created_at',
                    'status.name as status', 'users.job_definition', 'users.department_name', 'users.school_name')
                ->where('ticket.creator_id', '=', Auth::user()->id)
                ->where('ticket.parent_id', '=', 0)
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
            ->select('ticket.id', 'users.name', 'ticket.creator_id', 'ticket.title', 'ticket.content',
                'status.name as status', 'ticket.created_at')
            ->join('users', 'users.id', '=', 'ticket.creator_id')
            ->join('status', 'status.id', '=', 'ticket.status')
            ->where('ticket.id', '=', $id)
            ->get();

        $ticketDetail = DB::table('ticket')
            ->select('users.name', 'ticket.created_at', 'ticket.content', 'ticket.creator_id'
                , 'ticket.parent_id', 'ticket.id as td_id')
            ->join('users', 'users.id', '=', 'ticket.creator_id')
            ->where('ticket.parent_id', '=', $id)
            ->orderByDesc('ticket.id')
            ->get();

        $ticketFiles = DB::table('files')
            ->select('file')
            ->where('ticket_id', '=', $id)
            ->get();
        $ticketFilesObj = json_decode($ticketFiles);

        $ticketMessageFiles = DB::table('files')
            ->select('ticket.id', 'files.file')
            ->join('ticket', 'ticket.id', '=', 'files.ticket_id')
            ->where('ticket.parent_id', '=', $id)
            ->get();
        $ticketMsgObj = json_decode($ticketMessageFiles);
        //dd($ticketMsgObj);

        $ticketID = json_decode($ticketData)[0]->id;

        return view('ticketDetay', json_decode(json_encode(['ticketData' => $ticketData,
            'ticketDetail' => $ticketDetail, 'ticketID'=>$ticketID, 'ticket_files'=>$ticketFilesObj,
            'ticket_msg_files'=>$ticketMsgObj]), true));
    }

    public static function resolveTicket(Request $request)
    {
        DB::table('ticket')->where("id", '=', $request->ticket_id)->update([
            "status" => $request->status
        ]);

        DB::table('ticket_detail')->insert([
            "creator_id"    => Auth::id(),
            "ticket_id"     => $request->ticket_id,
            "reply"         => $request->metin,
        ]);

        return back();
        //->withInput($request->ticket_id)
    }

    public function addNewAnswer(Request $request)
    {
        $file = null;
        $file_path = null;

        DB::table('ticket')->insert([
            "creator_id"    => Auth::id(),
            "parent_id"     => $request->ticket_id,
            "title"         => null,
            "content"       => $request->ticket_content,
        ]);

        if ($request->validate([
            'file.*' => ['nullable', "mimes:jpeg,jpg,png,pdf,xls,word", 'max:65536']])) {
            $file = $request->file;
        }

        if ($request->hasFile('file')) {
            foreach ($request->file as $file) {
                $file_path = $file->store('ticketFile', 'public');
                $new_id = json_decode(json_encode(DB::table('ticket')
                    ->select("id")
                    ->orderByDesc("id")
                    ->first()));

                FileModel::create([
                    "ticket_id"     => $new_id->id+1,
                    "file"          => $file_path,
                    "created_at"    => Carbon::now(+3)
                ]);
            }
        }
        return back();
    }
}
