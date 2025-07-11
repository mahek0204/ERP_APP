<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserloginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\LeadsController;

Route::get('/', function () {
    return view('welcome');
});



Route::controller(AdminController::class)->group(function() {
   // Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/home', 'home')->name('home');
   // Route::get('/home','index'])->name('admin.home');
    Route::get('/logout', 'logout')->name('logout');
    
});

Route::post('user',[UserController::class,'data']);
Route::view('user','user.user');
 Route::view('user','user.user');
 Route::get('user',[UserController::class,'list']);
// Route::get('/user/{id}',[RoleController::class,'edit']); 
Route::get('user/{id}', [UserController::class, 'edit']);
Route::post('/user', [UserController::class, 'store']);
Route::put('user/{id}',[UserController::class,'update']); 

 


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function() {
     Route::resource('roles', RoleController::class);
     Route::resource('users', UserController::class);
    
 });

 // Add this for anchor-based deletion
Route::get('/roles/delete/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.roles');
Route::get('/users/delete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('users.users');






Route::resource('team', TeamController::class);
Route::get('/team/destroy/{id}',[App\Http\Controllers\TeamController::class,'destroy'])->name('team.team');
Route::get('/team/update{id}',[TeamController::class,'update']);


Route::post('/lead', [LeadsController::class, 'create']);
Route::get('/lead', [LeadsController::class, 'list']);
Route::get('/lead/{id}', [LeadsController::class, 'edit']);
Route::put('/lead/{id}', [LeadsController::class, 'EditMember']);
Route::get('delete/{id}',[LeadsController::class,'delete']);