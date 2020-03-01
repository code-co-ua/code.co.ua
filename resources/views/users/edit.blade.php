@extends('layouts.app')

@section('main-class', 'container')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Профіль</h3>
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" method="post" action="{{ route('profile.update') }}">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar avatar-xl" style="background-image: url({{ $user->avatar_url }})"></span>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Ім'я</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Опис</label>
                            <textarea name="about" class="form-control" rows="5">{{ $user->about }}</textarea>
                        </div>
                        <div class="form-footer">
                            <button class="btn btn-primary btn-block">Зберегти</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            hi
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img src="{{ $user->avatar_url }}"
                     alt="{{ $user->name }} avatar" class="float-left"
                     style="width: 150px; margin-right: 25px;">
                <form enctype="multipart/form-data" method="post" action="{{ route('profile.update') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Ім'я</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="avatar" class="col-sm-2 col-form-label">Фото</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="avatar">
                                <label class="custom-file-label" for="customFile">Avatar - choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="about" class="col-sm-2 col-form-label">Опис</label>
                        <div class="col-sm-10">
                            <text-editor name="about" value="{{ $user->about }}"></text-editor>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Оновити</button>
                    <a href="{{ route('users.show', ['id' => $user->id]) }}" class="btn btn-lg btn-info btn-block">
                        Перегляд профілю
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
