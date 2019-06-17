<?php

namespace App\Services;

use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * @param integer $id
     */
    public function attachCourse($id)
    {
        auth()->user()->courses()->syncWithoutDetaching($id);
    }

    /**
     * @param integer $id
     */
    public function attachLesson($id)
    {
        if (!auth()->user()->lessons->contains($id)) {
            auth()->user()->lessons()->attach($id);
            auth()->user()->increment('balance');
        }
    }

    public function getCompletedLessons()
    {
        if (!Auth::check()) {
            return;
        }

        $completedLessons =
            DB::table('lesson_user')
                ->select('lesson_id')
                ->whereIn('lesson_id', function ($query) {
                    $query->select('id')->from('lessons')->whereIn('section_id', function ($query) {
                        $query->select('id')->from('sections')->whereRaw('`sections`.`course_id` = `courses`.`id`');
                    });
                });

        return $completedLessons;
    }

    public function handleUploadedImage(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');

            if (Auth::user()->avatar == 'user') Cloudder::delete(Auth::user()->avatar);

            Cloudder::upload($avatar);

            $result = Cloudder::getResult();
            return $result['public_id'];
        }
    }
}