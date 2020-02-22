<?php

use Illuminate\Support\Facades\{Route, Auth};

/**
 * Before start, see all model bindings - visit provider:
 * @see \App\Providers\RouteServiceProvider::boot()
 * @link https://laravel.com/docs/master/routing#route-model-binding
 */

Route::view('/', 'welcome');

Route::group(['throttle' => '20,1'], function () {
    Auth::routes();
});

//User
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users', 'UserController')->only('index', 'show');

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {
    Route::get('/', 'UserController@edit')->name('profile.edit');
    Route::post('/', 'UserController@update')->name('profile.update');
    Route::get('articles', 'UserController@articles')->name('profile.articles');
});

Route::resource('courses', 'CourseController')->only(['index', 'show']);
Route::prefix('courses/{course}/')->group(function () {
    Route::get('{lesson}', 'LessonController@show')->name('lessons.show');
    Route::get('{lesson}/questions', 'LessonController@questions')->name('lessons.questions');
    Route::get('{lesson}/exercise', 'ExerciseController@show')->name('lessons.exercise')->middleware('auth');
    Route::get('complete', 'CourseController@complete')->middleware('auth')->name('courses.complete');
});

Route::resource('articles', 'ArticleController')->except(['destroy']);
Route::resource('media', 'MediaController')->except([
    'show', 'edit', 'update',
]);

Route::get('changes/{id}', 'ChangesController@show')->name('changes');
