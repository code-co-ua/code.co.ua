@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="d-flex justify-content-center flex-column" style="width: 150px">
                <img src="{{ $user->avatar_url }}"
                     alt="{{ $user->name }} avatar"
                     class="m-0 p-0">
                <h2 class="text-center">{{ $user->name }}</h2>
            </div>
        </div>

        @if($user->about)
            <div class="row justify-content-center text-center">
                @parsedown($user->about)
            </div>
        @endif

        <div class="row justify-content-center">
            <ul class="nav justify-content-center text-uppercase text-info">
                <li class="nav-item">
                    <a class="nav-link" href="#">Статті</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Коментарі</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Курси</a>
                </li>
            </ul>
        </div>
    </div>
@endsection