<?php

use Illuminate\Support\Facades\DB;

//TODO - refactor
Route::get('', ['as' => 'admin.dashboard', function () {
    $data = DB::select('SELECT COUNT(id) as lessons_count,
                        (SELECT COUNT(id) from users) as users_count,
                        (SELECT COUNT(id) from exercises) as exercises_count,
                        (SELECT COUNT(id) from questions) as questions_count
                        from lessons');

    return AdminSection::view(
        view('components.dashboard', ['data' => $data[0]]),
        'Панель'
    );
}]);