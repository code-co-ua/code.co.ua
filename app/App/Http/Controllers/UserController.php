<?php

namespace App\Http\Controllers;

use Domain\User\Actions\UpdateAvatar;
use Domain\User\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class UserController extends Controller
{
    public function index()
    {
        $users = User::latest('balance')->paginate(20);

        return view('users.index', ['users' => $users]);
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function edit()
    {
        return view('users.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request, UpdateAvatar $updateAvatar): RedirectResponse
    {
        $request->merge([
            'avatar' => $updateAvatar->execute($request)
        ]);

        Auth::user()->update($request->avatar ? $request->all() : $request->except('avatar'));

        return redirect()->route('profile.edit');
    }

    public function articles()
    {
        $articles = Auth::user()->articles()->latest()->paginate(20);

        return view('users.articles', ['articles' => $articles]);
    }
}
