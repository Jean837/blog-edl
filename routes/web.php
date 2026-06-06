<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\WaitlistController;
use App\Http\Controllers\CommentController as UserCommentController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

// ─── Blog public ──────────────────────────────────────────────────────────────
Route::get('/', [BlogController::class, 'index'])->name('blog.index');
Route::get('/article/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/a-propos', fn() => view('blog.about'))->name('blog.about');
Route::get('/createur', fn() => view('blog.creator'))->name('blog.creator');

// ─── Newsletter ───────────────────────────────────────────────────────────────
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// ─── Waitlist ─────────────────────────────────────────────────────────────────
Route::post('/waitlist', [WaitlistController::class, 'store'])->name('waitlist.store');
Route::get('/waitlist/count', [WaitlistController::class, 'count'])->name('waitlist.count');

// ─── Auth (Breeze) ────────────────────────────────────────────────────────────
require __DIR__.'/auth.php';

// ─── Vérification email ───────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/verify-email', [EmailVerificationController::class, 'show'])->name('verify.email.form');
    Route::post('/verify-email', [EmailVerificationController::class, 'verify'])->name('verify.email');
    Route::post('/verify-email/resend', [EmailVerificationController::class, 'resend'])->name('verify.email.resend');
});

// ─── Espace utilisateur connecté + vérifié ────────────────────────────────────
Route::middleware(['auth', 'verified.custom'])->group(function () {

    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('blog.index');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/article/{post}/comment', [BlogController::class, 'comment'])->name('blog.comment');
    Route::post('/article/{post}/rate', [RatingController::class, 'store'])->name('post.rate');
    Route::post('/article/{post}/like', [LikeController::class, 'toggle'])->name('post.like');

    Route::patch('/comment/{comment}', [UserCommentController::class, 'update'])->name('comment.update');
    Route::delete('/comment/{comment}', [UserCommentController::class, 'destroy'])->name('comment.destroy');
    Route::post('/comment/{comment}/report', [UserCommentController::class, 'report'])->name('comment.report');
});

// ─── Admin ────────────────────────────────────────────────────────────────────
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', AdminPostController::class);
    Route::resource('categories', CategoryController::class)->only(['index', 'store', 'destroy']);
    Route::post('/comments/{comment}/approve', [CommentController::class, 'approve'])->name('comments.approve');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}/promote', [UserController::class, 'promote'])->name('users.promote');
    Route::post('/users/{user}/demote', [UserController::class, 'demote'])->name('users.demote'); 
});