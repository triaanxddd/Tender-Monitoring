<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemandedGoodsController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskTrashController;
use App\Http\Controllers\UserController;

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
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');

Route::middleware(['auth'])->group(function () {
    //logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    //dashboard page
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    //task
    Route::resource('/tasks', TaskController::class);
    Route::get('/task_show/pdf/{id}', [TaskController::class, 'pdfDownload'])->name('pdfDownload');
    
    Route::get('/tasks/delete-file/{column}/{id}', [TaskController::class, 'deleteFile'])->name('deleteFile');
    Route::get('/tasks/deleteFileSubTask/{subtask}/{id}', [TaskController::class, 'deleteFileSubTask'])->name('deleteFileSubTask');
    Route::get('/task-list', [TaskController::class, 'taskList'])->name('taskList');

    //task trash and restore
    Route::get('/trash', [TaskTrashController::class, 'index'])->name('taskTrash');
    Route::post('/trash/restore/{id?}', [TaskTrashController::class, 'restoreTrash'])->name('restoreTrash');
	Route::post('/trash/delete/{id?}', [TaskTrashController::class, 'deleteTrash'])->name('deleteTrash');

    //category 
    Route::resource('/categories', CategoryController::class)->middleware('admin-role');


    //management
    Route::get('/management', [ManagementController::class, 'index'])->middleware('admin-role')->name('management');

    //members
    Route::resource('/users', UserController::class )->middleware('admin-role');
    Route::post('/users/change-password/{id}', [UserController::class, 'changePassword'])->name('changePassword')->middleware('admin-role');

    Route::get('/check-role', function(){
        dd('test');
    })->middleware('admin-role');

    Route::resource('/goods', GoodsController::class)->middleware('admin-role');
    Route::post('/create-demanded-goods',[ DemandedGoodsController::class, 'create'])->name('demandedGoodsCreate');

    Route::post('/goods-approve/{id}',[ DemandedGoodsController::class, 'approve'])->middleware('admin-role')->name('goods-approve');
    Route::post('/goods-disapprove/{id}',[ DemandedGoodsController::class, 'disapprove'])->middleware('admin-role')->name('goods-disapprove');
    Route::post('/goods-delete/{id}',[ DemandedGoodsController::class, 'destroy'])->middleware('admin-role')->name('goods-delete');

    // Add this route in your web.php or routes file
    Route::get('/dashboard/get_tasks_by_year', [DashboardController::class, 'getTasksByYear'])->name('get_tasks_by_year');

    //profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profileChange');
    Route::post('/profile-password', [ProfileController::class, 'updatePassword'])->name('updatePassword');

});