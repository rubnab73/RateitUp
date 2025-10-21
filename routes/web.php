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

// Image Management


// --------------------
// Admin Routes
// --------------------
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Users Management
        Route::get('/users', [DashboardController::class, 'users'])->name('users');
        Route::get('/users/{user}/edit', [DashboardController::class, 'editUser'])->name('users.edit');
        Route::patch('/users/{user}', [DashboardController::class, 'updateUser'])->name('users.update');
        Route::patch('/users/{user}/toggle-admin', [DashboardController::class, 'toggleAdmin'])->name('users.toggle-admin');
        
        // Topics Management
        Route::get('/topics', [DashboardController::class, 'topics'])->name('topics');
        Route::get('/topics/{topic}/edit', [DashboardController::class, 'editTopic'])->name('topics.edit');
        Route::patch('/topics/{topic}', [DashboardController::class, 'updateTopic'])->name('topics.update');
        Route::delete('/topics/{topic}', [DashboardController::class, 'destroyTopic'])->name('topics.destroy');
        
        // Reviews Management
        Route::get('/reviews', [DashboardController::class, 'reviews'])->name('reviews');
        Route::get('/reviews/{review}/edit', [DashboardController::class, 'editReview'])->name('reviews.edit');
        Route::patch('/reviews/{review}', [DashboardController::class, 'updateReview'])->name('reviews.update');
        Route::delete('/reviews/{review}', [DashboardController::class, 'destroyReview'])->name('reviews.destroy');
    });

require __DIR__ . '/auth.php';


Route::get('/test-admin', function () {
    return 'Admin middleware works!';
})->middleware('admin');
