@extends('layouts.article')

@section('title', "Додати статтю")

@section('base_content')
    <div id="app">
        <h3 class="text-success">Додати статтю</h3>
        <form method="post" action="{{ route('articles.store') }}" class="mb-5">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control form-control-lg" name="name" placeholder="Назва" required>
            </div>
            <div class="form-group">
                <input type="url" class="form-control" name="image" placeholder="URL Зображення" required>
            </div>
            <div class="form-group">
                <select class="form-control" name="category_id" required>
                    <option>Категорія</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <div class="alert alert-primary" role="alert">
                    <strong>Примітка:</strong> завантажити фото ви можете у розділі <a href="{{ route('media.index') }}"
                                                                                       class="btn-outline-primary btn"
                                                                                       target="_blank">медіа</a>.
                </div>

                <text-editor name="body"></text-editor>
            </div>

            <div class="form-group">
                <label for="tags">Теги (додавати через Enter)</label>
                <tags-input element-id="tags"
                            v-model="selectedTags" placeholder="Вводьте назву тегу і нажимайте Enter"></tags-input>
                <input type="hidden" name="tags" :value="selectedTags">
            </div>

            <button type="submit" class="btn btn-block btn-lg btn-outline-success">ДОДАТИ!</button>
        </form>
    </div>
@endsection
