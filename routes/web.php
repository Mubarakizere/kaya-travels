<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\TripPublicController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FlightPublicController;
use App\Http\Controllers\Admin\SiteImageController;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
// Route::get('/test-email', function () {
//     Mail::raw('This is a test email from Kaya Travels.', function ($message) {
//         $message->to('izeremubarak05@gmail.com')
//                 ->subject('Kaya Travels Email Test');
//     });

//     return '✅ Test email sent.';
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/service', 'service')->name('service');
Route::get('/destination', [DestinationController::class, 'index'])->name('destination');
Route::view('/gallery', 'gallery')->name('gallery');
Route::view('/contact', 'contact')->name('contact');
Route::view('/faq', 'faq')->name('faq');
Route::view('/success', 'success')->name('success');
Route::view('/404', 'errors.404')->name('404');
Route::get('/flights', [FlightPublicController::class, 'index'])->name('flights.index');
// Blog Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');

// Contact Form Submission
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Temporary Image Upload Testing
Route::view('/test-upload-form', 'test-upload');
Route::post('/test-upload', function (Request $request) {
    if ($request->hasFile('thumbnail')) {
        try {
            $path = $request->file('thumbnail')->store('trips/test', 'public');
            return "Image saved at: " . $path;
        } catch (\Exception $e) {
            return "Storage failed: " . $e->getMessage();
        }
    }
    return "No file uploaded.";
});

/*
|--------------------------------------------------------------------------
| Trip Pages (Public)
|--------------------------------------------------------------------------
*/
Route::get('/trips', [TripPublicController::class, 'index'])->name('trips.public.index');
Route::get('/trips/{slug}', [TripPublicController::class, 'show'])->name('trips.public.show');

/*
|--------------------------------------------------------------------------
| Booking Submission (Public but secured via login form)
|--------------------------------------------------------------------------
*/
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

/*
|--------------------------------------------------------------------------
| User Profile (Authenticated)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
       Route::resource('flights', \App\Http\Controllers\Admin\FlightController::class);
    // Trips
    Route::resource('/trips', TripController::class);
    Route::get('/trips/{trip}/upload-images', [TripController::class, 'uploadImagesForm'])->name('trips.uploadImages');
    Route::post('/trips/{trip}/upload-images', [TripController::class, 'uploadImages'])->name('trips.uploadImages.store');

    // Blog Posts
    Route::resource('/posts', PostController::class);
    Route::post('/posts/trix-upload', [PostController::class, 'uploadTrixImage'])->name('posts.trix-upload');
    Route::resource('/categories', CategoryController::class)->except(['show']);
    Route::resource('destinations', \App\Http\Controllers\Admin\DestinationController::class);

    // Bookings
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.status');

    // Site Images
    Route::get('/site-images', [SiteImageController::class, 'index'])->name('site-images.index');
    Route::post('/site-images', [SiteImageController::class, 'update'])->name('site-images.update');
});

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'customer'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});



/*
|--------------------------------------------------------------------------
| Universal Dashboard Redirect (Role-Based)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {
    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Auth Routes (Login, Register, Forgot Password, etc.)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
