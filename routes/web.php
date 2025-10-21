<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

// --------------------
// Public Routes
// --------------------
Route::get('/', [TopicController::class, 'index'])->name('home');

// --------------------
// Dashboard (for logged in users)
// --------------------
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --------------------
// Authenticated User Routes
// --------------------
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications', [NotificationController::class, 'clearAll'])->name('notifications.clearAll');
});

// --------------------
// Public Resource Routes
// --------------------
Route::resource('topics', TopicController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('comments', CommentController::class);

// --------------------
// Following System
// --------------------
Route::post('/users/{user}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/users/{user}/follow', [FollowerController::class, 'destroy'])->name('users.unfollow');
Route::get('/users/{user}/followers', [FollowerController::class, 'followers'])->name('users.followers');
Route::get('/users/{user}/following', [FollowerController::class, 'following'])->name('users.following');

// --------------------
// Tags
// --------------------
Route::resource('tags', TagController::class);
Route::post('/topics/{topic}/tags', [TagController::class, 'attachTag'])->name('topics.tags.attach');
Route::delete('/topics/{topic}/tags/{tag}', [TagController::class, 'detachTag'])->name('topics.tags.detach');

// --------------------
// Admin Routes
// --------------------
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/users', [DashboardController::class, 'users'])->name('users');
        Route::get('/topics', [DashboardController::class, 'topics'])->name('topics');
        Route::get('/reviews', [DashboardController::class, 'reviews'])->name('reviews');
        Route::patch('/users/{user}/toggle-admin', [DashboardController::class, 'toggleAdmin'])->name('users.toggle-admin');
        Route::delete('/topics/{topic}', [DashboardController::class, 'destroyTopic'])->name('topics.destroy');
        Route::delete('/reviews/{review}', [DashboardController::class, 'destroyReview'])->name('reviews.destroy');
    });

require __DIR__ . '/auth.php';


Route::get('/test-admin', function () {
    return 'Admin middleware works!';
})->middleware('admin');
