@extends('layouts.app')

@section('title', 'Користувачі - '. config('app.name'))

@section('head')
    <style>
        .user::after {
            position: absolute;
            top: -1px;
            right: 15px;
            left: 20px;
            display: block;
            border-top: 1px solid #d9dfe0;
            content: "";
        }

        .user img {
            width: 150px;
            margin-right: 25px;
        }

        .user span {

        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Користувачі</div>

                    <div class="card-body">
                        {{ $users->links() }}
                        <div class="row">
                            @foreach($users as $user)
                                <div itemscope itemtype="http://schema.org/Person" class="user col-lg-12 p-lg-3">
                                    <span class="badge badge-success float-right"
                                          style="font-size: 15px;">{{ $user->balance }}</span>
                                    <a href="{{ route('users.show', ['user' => $user->id]) }}" itemprop="url" class="text-info">
                                        <img src="{{ $user->avatar_url }}"
                                             alt="{{ $user->name }}"
                                             class="float-left"
                                             itemprop="image">
                                        <h2 itemprop="name">{{ $user->name }}</h2>
                                    </a>
                                    <p itemprop="description">{{ str_limit($user->about, 350) }}</p>
                                </div>
                            @endforeach
                        </div>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
