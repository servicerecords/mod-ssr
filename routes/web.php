<?php

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

Route::get('cookie-test', function() {

   return redirect('test-redirect')->withCookie($cookie);
});

Route::get('test-redirect', function(Request $request) {
    $cookie = \Cookie::get('cookie');
    dd($cookie);
});

Route::get('/countries', function()
{
    return Countries::getList('en', 'json');
});

Route::get('/', 'ServiceRecordController@index');
Route::get('/request', 'ServiceRecordController@recordRequest');
Route::get('/service', 'ServiceRecordController@serviceChoice');
Route::get('/service/death-in-service', 'ServiceRecordController@deathInService');
Route::get('/essential-information', 'ServiceRecordController@essentialInformation');
Route::get('/service-details', 'ServiceRecordController@serviceDetails');
Route::get('/your-details', 'ServiceRecordController@yourDetails');
Route::get('your-details/relationship', 'ServiceRecordController@relationship');
Route::get('your-details/relation', 'ServiceRecordController@relation');
Route::get('your-details/communication', 'ServiceRecordController@communication');
Route::get('/check-your-answers', 'ServiceRecordController@checkYourAnswers');
Route::get('/verify', 'ServiceRecordController@verify');

Route::post('/request', 'ServiceRecordController@recordRequestSave');
Route::post('/service', 'ServiceRecordController@serviceChoiceSave');
Route::post('/service/death-in-service', 'ServiceRecordController@deathInServiceSave');
Route::post('/essential-information', 'ServiceRecordController@essentialInformationSave');
Route::post('/service-details', 'ServiceRecordController@serviceDetailsSave');
Route::post('/your-details', 'ServiceRecordController@yourDetailsSave');
Route::post('/your-details/relationship', 'ServiceRecordController@yourDetailsRelationshipSave');
Route::post('/your-details/relation', 'ServiceRecordController@yourDetailsRelationSave');
Route::post('/your-details/communication', 'ServiceRecordController@communicationSave');
Route::post('/verify', 'ServiceRecordController@verifySave');

Route::get('/feedback', 'FeedbackController@index');
Route::get('/feedback/success', 'FeedbackController@success');
Route::post('/feedback', 'FeedbackController@save');

Route::get('/help/accessibility-statement', 'HelpController@accessibility');

#Route::get('/pay', 'PaymentController@payment');
Route::get('/pay', 'PaymentController@processPayment');

Route::get('/confirmation', 'ConfirmationController@index');

