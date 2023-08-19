<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketReplyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    if (!Auth::user()) {
        return view('auth.login');
    }
    if (Auth::user()->hasRole('admin')) {
        return redirect()->route('dashboard');
    }
    return view('backend.dashboard.user.home');
})->name('welcome');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', [ProfileController::class, 'profile'])->name('profile');
        Route::post('/', [ProfileCOntroller::class, 'update'])->name('update');
    });

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::group(['prefix' => '{user}'], function () {
            Route::post('delete', [UserController::class, 'delete'])->name('delete');
            Route::get('edit', [UserController::class, 'edit'])->name('edit');
            Route::post('update', [UserController::class, 'update'])->name('update');
        });
    });


    Route::group(['prefix' => 'tickets', 'as' => 'tickets.'], function () {
        Route::get('/', [TicketController::class, 'index'])->name('index');
        Route::get('/tickets', [TicketController::class, 'admin'])->name('admin')->middleware('role:admin');;
        Route::get('/filter', [TicketController::class, 'filter'])->name('filter')->middleware('role:admin');;
        Route::get('create', [TicketController::class, 'create'])->name('create');
        Route::post('store', [TicketController::class, 'store'])->name('store');
        Route::post('update-status', [TicketController::class, 'updateStatus'])->name('update-status');
        Route::get('get-details', [TicketController::class, 'getDetails'])->name('get-details');
        Route::post('send-mail', [TicketController::class, 'sendMail'])->name('send-mail');
        Route::group(['prefix' => '{user}'], function () {
            Route::post('delete', [TicketController::class, 'delete'])->name('delete');
            Route::get('edit', [TicketController::class, 'edit'])->name('edit');
            Route::post('update', [TicketController::class, 'update'])->name('update');
        });
    });

    Route::group(['prefix' => 'replies', 'as' => 'replies.', 'middleware' => 'role:user'], function () {
        Route::get('/', [TicketReplyController::class, 'index'])->name('index');
    });

});
