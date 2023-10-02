<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;

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

// 🔽 ここを編集
Route::middleware('auth')->group(function () {
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comment.update');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comment.edit');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    // 🔽 追加（検索画面）
    Route::get('/tweet/search/input', [SearchController::class, 'create'])->name('search.input');
    // 🔽 追加（検索処理）
    Route::get('/tweet/search/result', [SearchController::class, 'index'])->name('search.result');
    Route::get('/tweet/timeline', [TweetController::class, 'timeline'])->name('tweet.timeline');
    Route::get('user/{user}', [FollowController::class, 'show'])->name('follow.show');
    Route::post('user/{user}/follow', [FollowController::class, 'store'])->name('follow');
    Route::post('user/{user}/unfollow', [FollowController::class, 'destroy'])->name('unfollow');
    Route::post('tweet/{tweet}/favorites', [FavoriteController::class, 'store'])->name('favorites');
    Route::post('tweet/{tweet}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');
    Route::get('/tweet/mypage', [TweetController::class, 'mydata'])->name('tweet.mypage');
    Route::resource('tweet', TweetController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';