@extends('layouts.article')

@section('title', 'Мої статті')

@section('base_content')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('articles.index') }}">Статті</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('profile.articles') }}">Мої статті</a>
                </li>
            </ul>
        </div>
        @foreach($articles as $article)
            <div class="col-md-12">
                <a href="{{ route('articles.edit', ['id' => $article->id]) }}" class="nav-link">
                    <h3>
                        <span class="badge badge-info text-uppercase">{{ $article->status_text }}</span>
                        {{ $article->name }}
                    </h3>
                </a>
            </div>
        @endforeach
    </div>
@endsection
