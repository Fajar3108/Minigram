<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    PostController,
    TagController,
    CommentController,
    DashboardController,
    FollowController
};

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

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/profile/settings', function() {
        return view('user.edit');
    });
    Route::get('/profile/{user:username}', [UserController::class, 'show']);

    Route::get('/profile/{user:username}/followers', [UserController::class, 'follows']);
    Route::get('/profile/{user:username}/followings', [UserController::class, 'follows']);

    Route::post('/follow', [FollowController::class, 'followUserRequest'])->name('follow');

    Route::get('blog/create', [PostController::class, 'create'])->name('blog.create');
    Route::post('blog/create', [PostController::class, 'store'])->name('blog.store');

    Route::get('blog/{post:id}/edit', [PostController::class, 'edit'])->name('blog.edit');
    Route::post('blog/{post:id}/edit', [PostController::class, 'update'])->name('blog.update');

    Route::get('blog/{post:id}/show', [PostController::class, 'show'])->name('blog.show');

    Route::delete('blog/{post:id}/delete', [PostController::class, 'destroy'])->name('blog.destroy');

    Route::get('blog/explore/', [PostController::class, 'explore']);

    Route::get('blog/explore/tags/{tag:slug}', [TagController::class, 'index']);
    Route::get('blog/explore/search', [TagController::class, 'search'])->name('search');

    Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.add');
    Route::delete('/comment/delete/{comment:id}', [CommentController::class, 'destroy'])->name('comment.delete');

    Route::post('/reply/store', [CommentController::class, 'replyStore'])->name('reply.add');

    Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('admin/users', [DashboardController::class, 'manageUsers'])->name('dashboard.users');
    Route::get('admin/tags', [TagController::class, 'listTags'])->name('dashboard.tags');

    Route::post('tag/store', [TagController::class, 'store']);
    Route::delete('tag/delete/{tag:id}', [TagController::class, 'destroy']);

});
