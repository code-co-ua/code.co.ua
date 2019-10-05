<a class="navbar-brand" href="{{ auth()->check() ? route('home') : url('/') }}" data-turbolinks="false">
    <div>
        <span>C</span>
        <img src="{{ asset('img/idea.svg') }}" alt="CODE logo" id="logo">
        <span>DE</span>
    </div>
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
    <!-- Left Side Of Navbar -->
    <ul class="navbar-nav nav-tabs border-0 mr-auto">
        <li class="nav-item">
            <a class="nav-link {{ active('courses.*') }}" href="{{ route('courses.index') }}">{{ __('Курси') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ active('articles.*') }}" href="{{ route('articles.index') }}">{{ __('Статті') }}</a>
        </li>
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link {{ active('users.index') }}" href="{{ route('users.index') }}">{{ __('Користувачі') }}</a>
        </li>
        <!-- Authentication Links -->
        @guest
            <li class="nav-item">
                <a class="nav-link {{ active('login') }}" href="{{ route('login') }}">{{ __('Увійти') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ active('register') }}" href="{{ route('register') }}">
                    {{ __('Зареєструватись') }}
                </a>
            </li>
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown"
                   class="nav-link dropdown-toggle"
                   data-turbolinks="false"
                   href="#"
                   role="button"
                   data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false">
                    {{ Auth::user()->name }}
                    <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">Профіль</a>
                    <a class="dropdown-item" href="{{ route('media.index') }}">Медіа</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       data-turbolinks="false"
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        {{ __('Вийти') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</div>