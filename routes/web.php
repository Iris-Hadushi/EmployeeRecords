<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;

use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class,'index'])->middleware('auth')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/admin/user/{user}', [HomeController::class, 'destroyUser'])->name('admin.user.delete');
    Route::post('/admin/user/create', [HomeController::class, 'createUser'])->name('admin.user.create');
    Route::get('/admin/user/create', [HomeController::class, 'showCreateUserForm'])->name('admin.user.create.form');
    Route::get('/admin/user/{user}/edit', [HomeController::class, 'editUser'])->name('admin.edit_user');
    Route::patch('/admin/user/{user}/update', [HomeController::class, 'updateUser'])->name('admin.update_user');
    Route::get('/departments/tree', [DepartmentController::class, 'showTree'])->name('departments.tree');
    Route::get('/departments/add', [DepartmentController::class, 'showAddForm'])->name('departments.add');
    Route::post('/departments/store', [DepartmentController::class, 'store'])->name('departments.store');
    Route::delete('/departments/delete', [DepartmentController::class, 'delete'])->name('departments.delete');
    Route::get('/departments/edit/{department}', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::patch('/departments/update/{department}', [DepartmentController::class, 'update'])->name('departments.update');

});

require __DIR__.'/auth.php';
