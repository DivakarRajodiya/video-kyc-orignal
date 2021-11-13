<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionAnswerController;
use App\Http\Controllers\RecordingController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\VideoLogController;
use App\Http\Controllers\LocaleController;

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
//    return view('welcome');
    return redirect('login');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Update Profile
Route::post('update-profile/{user}', [HomeController::class, 'updateProfile']);

// Agent
Route::resource('agents', AgentController::class)->except(['edit', 'update', 'destroy']);
Route::get('agents/{id}/edit', [AgentController::class, 'edit']);
Route::post('agents/{id}', [AgentController::class, 'update'])->name('agents.update');
Route::delete('agents/{id}', [AgentController::class, 'destroy'])->name('agents.destroy');

// Visitor
Route::resource('visitors', VisitorController::class);

// Room
Route::resource('rooms', RoomController::class);

// Chat
Route::resource('chats', ChatController::class);
Route::post('chats/get-messages', [ChatController::class, 'getMessages']);

// Users
Route::resource('users', Usercontroller::class);

// Question Answers
Route::resource('question-answers', QuestionAnswerController::class);

// Recordings
Route::resource('recordings', RecordingController::class);

// Configs
Route::resource('configs', ConfigController::class);
Route::post('configs/update', [ConfigController::class, 'update'])->name('configs.update');
Route::post('configs/delete', [ConfigController::class, 'destroy'])->name('configs.destroy');

// Video Logs
Route::resource('videoLogs', VideoLogController::class);

// Locales
Route::get('locale', [LocaleController::class, 'index'])->name('locale.index');
Route::post('locale', [LocaleController::class, 'store'])->name('locale.store');
Route::post('locale/update', [LocaleController::class, 'update'])->name('locale.update');
Route::post('locale/delete', [LocaleController::class, 'destroy'])->name('locale.destroy');
