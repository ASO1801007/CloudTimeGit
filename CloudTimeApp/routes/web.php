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
Route::get('/chat/{capsule_id}', [App\Http\Controllers\ChatController::class,'index'])->middleware('auth');
Route::get('/ajax/chat', [App\Http\Controllers\Ajax\ChatController::class,'index']);// メッセージ一覧を取得
Route::get('/ajax/message_create', [App\Http\Controllers\Ajax\ChatController::class,'create']);// チャット登録
Route::get('/demochat', [App\Http\Controllers\ChatController::class,'view']);

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

// メンバーリスト
Route::get('/member_list/{capsule_id}',[App\Http\Controllers\MemberController::class,'show_member_list'])->name('member.show_member_list')->middleware('auth');

// カプセルから招待する画面
Route::get('/member_add_select/{capsule_id}',[App\Http\Controllers\MemberController::class,'show_member_add_select'])->name('member.show_member_add_select')->middleware('auth');

// コードから参加する画面
Route::get('/entry_form',[App\Http\Controllers\EntryController::class,'show_entry_form'])->name('entry.show_entry_form')->middleware('auth');

// コードから参加する画面->検索
Route::post('/entry_search',[App\Http\Controllers\EntryController::class,'entry_select'])->name('entry.entry_select')->middleware('auth');

// コードから参加する画面->参加ボタン押下
Route::post('/entry_commit',[App\Http\Controllers\EntryController::class,'entry_commit'])->name('entry.entry_commit')->middleware('auth');

// ページから直接招待する
Route::get('/invitation/{user_id}',[App\Http\Controllers\EntryController::class,'show_invitation'])->name('entry.show_invitation')->middleware('auth');

// メンバー招待処理
Route::post('/member_update',[App\Http\Controllers\MemberController::class,'member_update'])->name('member.member_update')->middleware('auth');

Route::get('/mail', [App\Http\Controllers\HomeController::class, 'mail'])->name('mail');

Route::get('/testmaill', [App\Http\Controllers\HomeController::class, 'testmail'])->name('testmail');
