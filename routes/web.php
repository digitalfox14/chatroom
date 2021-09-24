<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FileManagerController;
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



Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('', [App\Http\Controllers\ChatRoomController::class, 'index'])->name('chatroom');
    Route::post('/chatroom/store',[App\Http\Controllers\ChatRoomController::class, 'store'])->name('chatroom.store');
    Route::get('/chatroom/{id}', [App\Http\Controllers\ChatRoomController::class, 'msgshow'])->name('chatroom.msgshow');
    
});

Route::middleware('auth')->name('task.')->group(function (){
    Route::post('/agile-board',[TaskController::class, 'store'])->name('store');
    Route::get('/index',[TaskController::class, 'index'])->name('index');
    Route::post('/task/{task}/change-status',[TaskController::class, 'changeStatus']);
    Route::post('/task/{task}/change-order',[TaskController::class, 'changeOrder']);
    Route::post('{task}/task/delete',[TaskController::class, 'destroy']);
    Route::post('/task/{task}/change-task',[TaskController::class, 'update']);
});


Route::middleware('auth')->name('filemanager.')->prefix('/filemanager')->group(function(){
    Route::post('/store',[FileManagerController::class, 'store'])->name('store');
    Route::get('/index', [FileManagerController::class, 'index'])->name('index');
    Route::get('/files', [FileManagerController::class, 'files'])->name('files');    
    Route::post('/share', [FileManagerController::class, 'ShareFiles'])->name('shareFiles');    
});
Route::post('/filemanager/{fileManager}/delete', [FileManagerController::class, 'destroy']);    
Route::get('/filemanager/share/{id}', [FileManagerController::class, 'share'])->name('files');    




