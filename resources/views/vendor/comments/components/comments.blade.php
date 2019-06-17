@auth
    @if(count($model->comments) < 1)
        <p class="lead">Поки що коментарів немає.</p>
    @endif

    <ul class="list-unstyled">
        @foreach($model->comments->where('parent', null) as $comment)
            @include('comments::_comment')
        @endforeach
    </ul>

    @include('comments::_form')
@else
    @if($model->comments->count() < 1)
        <p class="lead">Поки що коментарів немає.</p>
    @endif

    <ul class="list-unstyled">
        @foreach($model->comments->where('parent', null) as $comment)
            @include('comments::_comment')
        @endforeach
    </ul>

    <div class="card">
        <div class="card-body">
            <p class="card-text">Щоб залишити коментар, потрібно увійти або зареєструватись.</p>
            <div class="btn-group w-100">
                <a href="{{ route('login') }}" class="btn btn-lg btn-outline-primary w-100">Увійти</a>
                <a href="{{ route('register') }}" class="btn btn-lg btn-outline-primary w-100">Зареєструватись</a>
            </div>
        </div>
    </div>
@endauth