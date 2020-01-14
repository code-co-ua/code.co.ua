<?php

use Illuminate\Http\Request;

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

Route::post('exercise/check', 'ExerciseController@check');


//$encrypter = app(\Illuminate\Contracts\Encryption\Encrypter::class);
//
//$str = 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTWNZWE9pdmRPNkpXTWw3UDQ3c1NUOE5HOEpGb2Z0dEQ5NUJPckNjMCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==';
//
////// decrypt
//$decryptedString = $encrypter->decrypt($str, false);