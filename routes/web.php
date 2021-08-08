<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});

Route::get('/destroysesssion', function () {
    Auth::logout();
    return view('auth.login');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/software',[HomeController::class,'ManageSoft']);
Route::post('/newsoftware',[HomeController::class,'AddSoftware']);
Route::get('DeleteLogiciel/{id_logiciel}',[HomeController::class,'DeleteLogiciel']);
Route::post('updatesoftware', [HomeController::class, 'EditLogiciel']);
Route::get('/souscription',[HomeController::class,'Souscription']);
Route::post('/newsouscription',[HomeController::class,'NewSouscription']);
Route::get('/comparedate',[HomeController::class,'compareDate']);
Route::post('/updatesubscription',[HomeController::class,'UpdateSubscription']);
Route::post('/updatepayement',[HomeController::class,'UpdatePayement']);
Route::get('/sendmail',[HomeController::class,'SendMail']);
Route::get('/printinvoice/{id}',[HomeController::class,'PrintInvoice']);
Route::get('/pdf',[HomeController::class,'PDF']);
Route::get('/deletesouscription/{id}',[HomeController::class,'DeleteSubscriptions']);
Route::get('/send_toclient/{id}',[HomeController::class,'NotifyPayement']);
Route::get('/sav',[HomeController::class,'SAV']);
Route::post('/sav/fetch', [App\Http\Controllers\HomeController::class, 'fetch'])->name('sav.fetch');
Route::post('/savereclammation',[HomeController::class,'Savereclammation']);
Route::get('/deletereclammation/{id}',[HomeController::class,'DeleteReclammation']);
Route::get('/intervention/{id}',[HomeController::class,'Intervention']);
Route::post('/updatereclammtion',[HomeController::class,'UpdateReclammation']);
Route::post('/{id}/saveintervention',[HomeController::class,'SaveIntervention']);
Route::get('deleteintervention/{id}',[HomeController::class,'DeleteIntervention']);
Route::post('/savesuggestion',[HomeController::class,'SaveSuggestion']);
Route::get('/user',[UserController::class,'DisplayUser']);
Route::post('accessRight',[UserController::class,'AccessRight']);
Route::post('accessdenied',[UserController::class,'AccessDenied']);
Route::get('/deleteuser/{id}',[UserController::class,'DeleteUser']);













