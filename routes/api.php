<?php

use App\Http\Controllers\Api\ContactsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('contacts',[ContactsController::class,'index']);
Route::post('contacts',[ContactsController::class,'store']);
Route::get('contacts/{id}',[ContactsController::class,'show']);
Route::get('contacts/{id}/edit',[ContactsController::class,'edit']);
Route::put('contacts/{id}/edit',[ContactsController::class,'update']);
Route::delete('contacts/{id}/delete',[ContactsController::class,'destroy']);

// Route::get('student',function(){
//     return 'Hello This Is API CALL';
// });
