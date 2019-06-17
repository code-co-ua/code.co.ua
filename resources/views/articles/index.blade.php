@extends('layouts.article')

@section('title', 'Статті')

@section('base_content')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('articles.index') }}">Статті</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.articles') }}">Мої статті</a>
                </li>
            </ul>
        </div>
        @foreach($articles as $article)
            <div class="card-columns">
                <div class="card">
                    <a href="{{ route('articles.show', ['id' => $article->id]) }}" class="card-link">
                        <img class="card-img-top" src="{{ $article->image }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title mb-0">{{ $article->name }}</h5>
                            <small class="text-muted" title="Коли додано">
                                {{ $article->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection