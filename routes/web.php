<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'welcome');

Auth::routes();

//User
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users', 'UserController')->only('index', 'show');
Route::middleware(['auth'])->group(function () {
    Route::get('profile', 'UserController@edit')->name('profile.edit');
    Route::post('profile', 'UserController@update')->name('profile.update');
    Route::get('profile/articles', 'UserController@articles')->name('profile.articles');
});

//Course
Route::resource('courses', 'CourseController')->only(['index', 'show']);
Route::get('courses/{id}/complete', 'CourseController@complete')->middleware('auth')->name('courses.complete');
//Lessons
Route::get('lessons/{id}', 'LessonController@show')->name('lessons.show');
Route::get('lessons/{id}/questions', 'LessonController@questions')->name('lessons.questions');
Route::get('lessons/{id}/exercise', 'ExerciseController@show')->name('lessons.exercise');
//Articles
Route::resource('articles', 'ArticleController')->except(['destroy']);
Route::resource('media', 'MediaController')->except([
    'show', 'edit', 'update',
]);

Route::get('changes/{id}', 'ChangesController@show')->name('changes');
