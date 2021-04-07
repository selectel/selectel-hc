<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect('/tickets/index');
})->name('root');

Route::get('/tickets', function() {
    return redirect('/tickets/index');
})->name('root_tickets');

Route::get('/tickets/index', [TicketController::class, 'index'])->name('all_tickets');
Route::get('/ticket/{ticket_id}', [TicketController::class, 'show'])->where(['ticket_id' => '^([0-9])+'])->name('show_ticket');

Route::post('/ticket/new', [TicketController::class, 'new'])->name('new_ticket');
Route::post('/ticket/{ticket_id}/comments', [TicketController::class, 'update'])->where(['ticket_id' => '^([0-9])+', 'comment' => '^([0-9a-zA-Zа-яА-я])+'])->name('update_ticket');
Route::post('/ticket/{ticket_id}/close', [TicketController::class, 'close'])->where(['ticket_id' => '^([0-9])+'])->name('close_ticket');

