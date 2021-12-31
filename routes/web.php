<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
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
    return view('welcome');
});
Route::get("/home",function() {
echo 'this is a home page';
});

// Route::get('/about', function () {
//     return view('about');
// })->middleWare('age');

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact',[ContactController::class,"contact"])->name('con');
//category controller 

Route::get('/category/all',[CategoryController::class,'AllCat'])->name('all.category');
Route::post('/category/add',[CategoryController::class,'AddCat'])->name('store.category');

Route::post('/category/update/{id}',[CategoryController::class,'updateCat'])->name('update.category');


Route::get('/category/edit/{id}',[CategoryController::class,'editCat'])->name('edit.category');
Route::get('/category/Softdelete/{id}',[CategoryController::class,'deleteCat'])->name('delete.category');

Route::get('/category/restore/{id}',[CategoryController::class,'restoreCat'])->name('restore.category');
Route::get('/category/remove/{id}',[CategoryController::class,'removeCat'])->name('remove.category');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users =User ::all();
    $users=DB::table('users')->get();
    return view('dashboard',compact('users'));
})->name('dashboard');
