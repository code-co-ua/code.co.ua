<?php

/** @var $router Illuminate\Routing\Router */

$router->view('/', 'welcome');

// Auth
$router->middleware('throttle:15,1')->group(fn() => $router->auth());

$router->get('/home', 'HomeController@index')->name('home');
$router->resource('users', 'UserController')->only('index', 'show');

$router->group(['prefix' => 'profile', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/', 'UserController@edit')->name('profile.edit');
    $router->post('/', 'UserController@update')->name('profile.update');
    $router->get('articles', 'UserController@articles')->name('profile.articles');
});

$router->resource('courses', 'CourseController')->only(['index', 'show']);
$router->prefix('courses/{course}/')->group(function () use ($router) {
    $router->get('{lesson}', 'LessonController@show')->name('lessons.show');
    $router->get('{lesson}/questions', 'LessonController@questions')->name('lessons.questions');
    $router->get('{lesson}/exercise', 'ExerciseController@show')->name('lessons.exercise')->middleware('auth');
    $router->get('complete', 'CourseController@complete')->middleware('auth')->name('courses.complete');
});

$router->resource('articles', 'ArticleController')->except(['destroy']);
$router->resource('media', 'MediaController')->except([
    'show', 'edit', 'update',
]);

$router->get('changes/{id}', 'ChangesController@show')->name('changes');

$router->get('api/instances/{instance}/status', 'API\StreamInstanceStatus')->name('api.instance.status');
