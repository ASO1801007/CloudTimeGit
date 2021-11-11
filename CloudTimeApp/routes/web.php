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
Route::get('/top', [App\Http\Controllers\TopController::class, 'top'])->name('top.top')->middleware('auth');

//チャット画面
Route::get('/chat', [App\Http\Controllers\ChatController::class,'chat'])->middleware('auth');

//エントリー画面
Route::get('/entry', [App\Http\Controllers\EntryController::class,'entry'])->middleware('auth');

//マイページ画面
Route::get('/mypage_info/{user_id?}', [App\Http\Controllers\MypageController::class,'show_info'])->name('mypage.show_info')->middleware('auth');
//マイページ編集
Route::get('/mypage_edit', [App\Http\Controllers\MypageController::class,'show_edit'])->middleware('auth');
//マイページ更新->マイページ画面
Route::post('/mypage_update', [App\Http\Controllers\MypageController::class,'mypage_update'])->middleware('auth');

//カプセル作成画面
Route::get('/capsule_entry',[App\Http\Controllers\CapsuleController::class,'show_entry'])->middleware('auth');

//カプセル作成->ホーム画面
Route::post('/capsule_create',[App\Http\Controllers\CapsuleController::class,'capsule_create'])->middleware('auth');

//カプセル詳細画面
Route::get('/capsule_info/{capsule_id}',[App\Http\Controllers\CapsuleController::class,'show_info'])->name('capsule.show_info')->middleware('auth');

//カプセル編集画面
Route::get('/capsule_edit/{capsule_id}',[App\Http\Controllers\CapsuleController::class,'show_edit'])->middleware('auth');

//カプセル編集->カプセルホーム画面
Route::post('/capsule_update',[App\Http\Controllers\CapsuleController::class,'capsule_update'])->middleware('auth');

//カプセル削除->ホーム画面
Route::post('/capsule_delete',[App\Http\Controllers\CapsuleController::class,'capsule_delete'])->middleware('auth');

//画像追加画面
Route::post('/capsule_info/image',[App\Http\Controllers\ImageController::class,'index'])->name('image.index')->middleware('auth');
Route::post('/capsule_info//image',[App\Http\Controllers\ImageController::class,'store'])->name('image.store')->middleware('auth');

Route::get('/mail',[App\Http\Controllers\MailController::class,'sendmail'])->middleware('auth');