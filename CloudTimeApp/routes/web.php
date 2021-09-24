<?php

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
    return view('welcome');
});

//ログイン
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//トップ画面
Route::get('/top', [App\Http\Controllers\TopController::class, 'top']);

//チャット画面
Route::get('/chat', [App\Http\Controllers\ChatController::class,'chat']);

//エントリー画面
Route::get('/entry', [App\Http\Controllers\EntryController::class,'entry']);

//マイページ画面
Route::get('/mypage', [App\Http\Controllers\MypageController::class,'mypage']);
//マイページ編集
Route::post('/mypage/edit', [App\Http\Controllers\MypageController::class,'edit']);

//カプセル作成画面
Route::get('/capsule_entry',[App\Http\Controllers\CapsuleController::class,'show_entry']);

//カプセル作成->ホーム画面
Route::post('/capsule_create',[App\Http\Controllers\CapsuleController::class,'capsule_create']);

//カプセルホーム画面
Route::get('/capsule_info/{capsule_id}',[App\Http\Controllers\CapsuleController::class,'show_info']);