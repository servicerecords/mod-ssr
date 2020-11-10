<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [\App\Http\Controllers\ServiceController::class, 'index'])->name('home');

Route::get('/service', [\App\Http\Controllers\ServiceController::class, 'index'])->name('service');
Route::post('/service', [\App\Http\Controllers\ServiceController::class, 'save'])->name('service.save');
Route::get('/service/death-in-service', [\App\Http\Controllers\DeathInServiceController::class, 'index'])->name('death-in-service');
Route::post('/service/death-in-service', [\App\Http\Controllers\DeathInServiceController::class, 'save'])->name('death-in-service.save');
Route::get('/essential-information', [\App\Http\Controllers\EssentialInformationController::class, 'index'])->name('essential-information');
Route::post('/essential-information', [\App\Http\Controllers\EssentialInformationController::class, 'save'])->name('essential-information.save');
Route::get('/serviceperson-details', [\App\Http\Controllers\ServicepersonDetailsController::class, 'index'])->name('serviceperson-details');
Route::post('/serviceperson-details', [\App\Http\Controllers\ServicepersonDetailsController::class, 'save'])->name('serviceperson-details.save');
Route::get('/sending-documentation', [\App\Http\Controllers\SendingDocumentationController::class, 'index'])->name('sending-documentation');
Route::post('/sending-documentation', [\App\Http\Controllers\SendingDocumentationController::class, 'save'])->name('sending-documentation.save');
Route::get('/applicant-details', [\App\Http\Controllers\ApplicantDetailsController::class, 'index'])->name('applicant-details');
Route::post('/applicant-details', [\App\Http\Controllers\ApplicantDetailsController::class, 'save'])->name('applicant-details.save');
Route::get('/applicant-relationship', [\App\Http\Controllers\ApplicantRelationshipController::class, 'index'])->name('applicant-relationship');
Route::post('/applicant-relationship', [\App\Http\Controllers\ApplicantRelationshipController::class, 'save'])->name('applicant-relationship.save');
Route::get('/applicant-next-of-kin', [\App\Http\Controllers\ApplicantNextOfKinController::class, 'index'])->name('applicant-next-of-kin');
Route::post('/applicant-next-of-kin', [\App\Http\Controllers\ApplicantNextOfKinController::class, 'save'])->name('applicant-next-of-kin.save');
Route::get('/check-answers', [\App\Http\Controllers\CheckAnswersController::class, 'index'])->name('check-answers');
Route::post('/check-answers', [\App\Http\Controllers\CheckAnswersController::class, 'save'])->name('check-answers.save');
Route::get('/confirmation/{uuid}', [\App\Http\Controllers\ConfirmationController::class, 'paid'])->name('confirmation');
Route::get('/confirmation', [\App\Http\Controllers\ConfirmationController::class, 'free'])->name('confirmation');
Route::get('/cancel-application', [\App\Http\Controllers\CancelApplicationController::class, 'index'])->name('cancel-application');
Route::post('/cancel-application', [\App\Http\Controllers\CancelApplicationController::class, 'index'])->name('cancel-application.save');

Route::get('/cookie-policy', [\App\Http\Controllers\CookiePolicyController::class, 'index'])->name('cookie-policy');
Route::post('/cookie-policy', [\App\Http\Controllers\CookiePolicyController::class, 'save'])->name('cookie-policy.save');

// Customer feedback
Route::get('/feedback', [\App\Http\Controllers\FeedbackController::class, 'index'])->name('feedback');
Route::post('/feedback', [\App\Http\Controllers\FeedbackController::class, 'send'])->name('feedback.send');
Route::get('/feedback/complete', [\App\Http\Controllers\FeedbackController::class, 'complete'])->name('feedback.complete');


Route::view('/privacy-policy', 'privacy-policy')->name('privacy-policy');
Route::view('/accessibility-statement', 'accessibility-statement')->name('accessibility-statement');
