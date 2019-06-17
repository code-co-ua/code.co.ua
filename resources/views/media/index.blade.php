@extends('layouts.app')

@section('title', 'Медіа')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-primary">
                            {{ Auth::user()->name }}
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Медіа</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-5">
                <a href="{{ route('media.create') }}" class="btn btn-block btn-lg btn-outline-success text-uppercase">
                    Додати
                </a>
            </div>
        </div>
        <div class="row" id="app">
            @forelse($medias as $media)
                <div class="col-sm-4">
                    <div class="card">
                        <img class="card-img-top" src="{{ Cloudder::show($media->name, ['quality' => 'auto:low']) }}"
                             alt="Card image cap">
                        <textarea class="card-text p-1" cols="10" rows="2" readonly>
                            {{ Cloudder::show($media->name) }}
                        </textarea>
                        <form action="{{ route('media.destroy', ['id' => $media->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline-danger btn-block rounded-0 text-uppercase" type="submit">
                                Видалити
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-lg-12">
                    <div class="alert alert-primary mt-1" role="alert">
                        У вас немає доданих медіа.
                    </div>
                </div>
            @endforelse
        </div>

        {{ $medias->links() }}
    </div>
@endsection