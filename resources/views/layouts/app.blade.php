<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">e-Sim Tools</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"
                       aria-expanded="false">Economy<span
                                class="caret"></span></a>
                    <div class="dropdown-menu">
                    <a class="nav-link" href="/exchange">Exchange</a>
                    <a class="nav-link" href="/products">Products</a>
                    <a class="nav-link" href="/jobs">Job Offers</a>
                    <a class="nav-link" href="/company">Company Calculator</a>
                    </div>
            </ul>
            </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"
                       aria-expanded="false">{{ ucwords(Session::get('esim_server', 'primera')) }} <span
                                class="caret"></span></a>
                    <div class="dropdown-menu">
                        <a class="nav-link" onclick="onServerChange('primera')">Primera</a>
                        <a class="nav-link" onclick="onServerChange('secura')">Secura</a>
                        <a class="nav-link" onclick="onServerChange('suna')">Suna</a>
                        <a class="nav-link" onclick="onServerChange('omega')">Omega</a>
                        <a class="nav-link" onclick="onServerChange('alpha')">Alpha</a>
                    </div>
                </li>

                <!-- Authentication Links
                @if (Auth::guest())
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif-->
            </ul>
        </div>
    </nav>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="/">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">Economy<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/exchange">Exchange</a></li>
                                <li><a href="/products">Products</a></li>
                                <li><a href="/jobs">Job Offers</a></li>
                                <li><a href="/company">Company Calculator</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">{{ ucwords(Session::get('esim_server', 'XIX')) }} <span
                                        class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a onclick="onServerChange('primera')">Primera</a></li>
                                <li><a onclick="onServerChange('secura')">Secura</a></li>
                                <li><a onclick="onServerChange('suna')">Suna</a></li>
                                <li><a onclick="onServerChange('WW2')">WW2</a></li>
                                <li><a onclick="onServerChange('XIX')">XIX</a></li>
                                <li><a onclick="onServerChange('xaria')">Xaria</a></li>
                            </ul>
                        </li>

                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('javascript')
</body>
</html>