<?php

namespace Domain\User\Services;

use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getCompletedLessons()
    {
        return DB::table('lesson_user')
                ->select('lesson_id')
                ->whereIn('lesson_id', function ($query) {
                    $query->select('id')->from('lessons')->whereIn('section_id', function ($query) {
                        $query->select('id')->from('sections')->whereRaw('`sections`.`course_id` = `courses`.`id`');
                    });
                });
    }

    /**
     * @todo Refactor.
     */
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