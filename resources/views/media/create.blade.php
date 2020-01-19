@extends('layouts.app')

@section('title', 'Додати медіа')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-primary">
                    {{ Auth::user()->name }}
                </li>
                <li class="breadcrumb-item"><a href="{{ route('media.index') }}">Медіа</a></li>
                <li class="breadcrumb-item active" aria-current="page">Додати</li>
            </ol>
        </nav>

        <form action="{{ route('media.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="photos[]" multiple>
                <label class="custom-file-label" for="customFile">Вибиріть фото для завантаження</label>
            </div>

            <button type="submit" class="btn btn-block btn-outline-success btn-lg">ДОДАТИ</button>
        </form>
    </div>
@endsection
