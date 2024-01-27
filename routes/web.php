<?php

use App\Http\Controllers\Authentication;
use Illuminate\Support\Facades\Route;



Route::middleware('guest')->group(function () {
    Route::get('/', [Authentication\SigninController::class, 'index'])->name('sign-in.index');
    Route::get('/sign-in', [Authentication\SigninController::class, 'index'])->name('sign-in.index');
    Route::post('/sign-in-now', [Authentication\SigninController::class, 'signIn'])->name('sign-in');

    Route::fallback(function () {
        return redirect()->back(); // Replace 'home' with the desired route name or URL
    });
});

Route::get('/change-password', [Authentication\ChangePasswordController::class, 'index'])->name('change-password');
Route::post('/sign-out', [Authentication\SignoutController::class, 'signOut'])->name('sign-out');
Route::post('change-password/{user_information}', [Authentication\ChangePasswordController::class, 'changePassword'])->name('change-password.update');
Route::post('/first-time-change-login', [Authentication\ChangePasswordController::class, 'firstTimeLogin'])->name('first-time-change-login.update');
Route::get('contents.auth.registration', [Authentication\RegistrationController::class, 'registration'])->name('registration');
Route::post('post-registration', [Authentication\RegistrationController::class, 'postRegistration'])->name('registration.post');