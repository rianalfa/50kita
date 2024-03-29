<?php

use App\Http\Livewire\Helpdesk\Main as HelpdeskMain;
use App\Http\Livewire\Notifications\Show;
use App\Http\Livewire\Task\MyTask;
use App\Http\Livewire\Team\Detail as TeamDetail;
use App\Http\Livewire\Team\Show as TeamShow;
use App\Http\Livewire\Template\Show as TemplateShow;
use App\Http\Livewire\User\UserList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('dashboard');
    } else {
        return redirect('login');
    }
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/users', UserList::class)->name('users');

    Route::get('notifications', Show::class)
        ->name('notifications');

    Route::name('helpdesk.')->group(function() {
        Route::get('/helpdesk', HelpdeskMain::class)->name('main');
    });

    Route::prefix('teams')->group(function() {
        Route::get('', TeamShow::class)->name('teams.main');
        Route::get('/{id}', TeamDetail::class)->name('teams.detail');
    });

    Route::get('tasks', MyTask::class)->name('tasks');

    //Routes for admin
    Route::middleware(['admin'])->group(function() {
        Route::get('/templates', TemplateShow::class)->name('templates');
    });
});
