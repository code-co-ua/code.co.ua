@extends('layouts.article', ['categories' => $categories])

@section('title', "Редагувати статтю")

@section('base_content')
    <div id="app">
        <h3 class="text-success">Редагувати статтю</h3>
        <form method="post" action="{{ route('articles.store') }}" class="mb-5">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control form-control-lg" name="name" placeholder="Назва" required value="{{ $article->name }}">
            </div>
            <div class="form-group">
                <input type="url" class="form-control" name="image" placeholder="Зображення" required value="{{ $article->image }}">
            </div>
            <div class="form-group">
                <select class="form-control" name="category_id" required>
                    <option>Категорія</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $article->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <div class="alert alert-primary" role="alert">
                    <strong>Примітка:</strong> завантажити фото ви можете у розділі <a href="{{ route('media.index') }}"
                                                                                       class="btn-outline-primary btn"
                                                                                       target="_blank">медіа</a>.
                </div>

                <text-editor name="body" value="{{ $article->body }}"></text-editor>
            </div>

            <button type="submit" class="btn btn-block btn-lg btn-outline-success">РЕДАГУВАТИ</button>
        </form>
    </div>
@endsection