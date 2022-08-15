<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\TicketDetayController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ListController;

Auth::routes();


Route::get('/',[TicketController::class, 'index'])->name('home')->middleware('auth');


Route::get('home', [TicketController::class, 'index'])->name('home')->middleware('auth');
Route::get('home/list', [TicketController::class, 'getAllTickets'])->name('home.list')
    ->middleware('auth');

Route::get('/view-ticket', [TicketController::class, 'getUserName']);
Route::post('/open-ticket', [TicketController::class, 'openTicket'])->name("openTicket");

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/api-deneme', [ApiController::class, 'index']);
Route::post('/api-deneme', [ApiController::class, 'login']);

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/ticket/{id}', [TicketController::class, 'getTicketDetails'])->name('ticketDetail')
    ->middleware('auth');

Route::post('/answer', [TicketDetayController::class, 'addNewAnswer'])->name('newAnswer');

Route::get('/newTicket', function () {
    return view('newTicket');
})->name('newTicket')->middleware('auth');

Route::get('deneme', [ListController::class, 'index']);
Route::get('deneme/list', [ListController::class, 'getTickets'])->name('deneme');

Route::get('mailgonder', [\App\Http\Controllers\MailController::class, 'send']);

Route::get('edit', function(){
    return view('edit');
});

Route::post('updateTicket', [TicketController::class, 'updateTicketStatus'])->name('updateTicket');


Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path('public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('/user-detail', function (){
    return view('user_ticket_detail');
});
