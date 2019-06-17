<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest('balance')->paginate(20);

        return view('users.index', ['users' => $users]);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('users.edit', ['user' => Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->merge([
            'avatar' => $this->userService->handleUploadedImage($request)
        ]);

        Auth::user()->update($request->avatar ? $request->all() : $request->except('avatar'));

        return redirect()->route('profile.edit');
    }

    public function articles()
    {
        $articles = Auth::user()->articles()->latest()->paginate(20);
        $categories = Category::all();

        return view('users.articles', ['articles' => $articles, 'categories' => $categories]);
    }
}
