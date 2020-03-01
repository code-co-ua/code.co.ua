<?php

namespace Domain\User\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JD\Cloudder\Facades\Cloudder;

final class UpdateAvatar
{
    /**
     * @todo Use DataObject and validation
     */
    public function execute(Request $request): string
    {
        if (!$request->hasFile('avatar')) {
            throw new \Exception();
        }

        $avatar = $request->file('avatar');

        if (Auth::user()->avatar == 'user') Cloudder::delete(Auth::user()->avatar);

        Cloudder::upload($avatar);

        $result = Cloudder::getResult();
        return $result['public_id'];
    }
}
