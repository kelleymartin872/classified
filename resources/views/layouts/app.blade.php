<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mayeconcept Web services') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    {{-- @vite(['resources/css/app.css']); --}}
    @vite(['resources/js/app.js']);
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-danger text-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    @if (Auth::user()->role_id == 2)
                                        <a class="dropdown-item" href="{{ route('user.ads.view') }}" style="color:blue">
                                            <i class="fas fa-camera"  style="color:blue"></i> {{ __('Ads') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ url('messages') }}" style="color:blue">
                                            <i class="fas fa-envelope" style="color:blue"></i> {{ __('Messages') }}
                                        </a>
                                    @endif
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        {{-- second nav --}}
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm navbar-hover">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHover"
                aria-controls="navbarDD" aria-expanded="false" aria-label="Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarHover">
                <ul class="container-fluid navbar-nav" id="slider-i" >
                    @foreach($menus as $menuItem)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="{{route('category.show',$menuItem->slug)}}"
                            data-toggle="dropdown_remove_dropdown_class_for_clickable_link" arial-haspopup="true"
                            aria-expanded="false">
                            {{$menuItem->name}}
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($menuItem->subcategories as $subMenuItem)
                                <li>
                                    <a class="dropdown-item dropdown-toggle" href="{{route('subcategory.show',[$menuItem->slug,$subMenuItem->slug])}} ">{{$subMenuItem->name}}</a>
                                    <ul class="dropdown-menu">
                                        @foreach ($subMenuItem->childcategories as $childMenu)
                                            <li>
                                                <a class="dropdown-item" href="{{route('childcategory.show',[$menuItem->slug,$subMenuItem->slug,$childMenu->slug])}} ">{{$childMenu->name}}
                                                </a>
                                            </li>
                                            
                                        @endforeach
                                    </ul>
                                </li>
                                
                            @endforeach

                        </ul>
        
                    </li>
                    @endforeach
                </ul>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue-chat-scroll/dist/vue-chat-scroll.min.js"></script> --}}
    <style>
       body{
            overflow-x: hidden;
        }
       .navbar-nav{
           height: 55px!important;
       }
        .dropdown:hover>.dropdown-menu {
            display: block;
        }

        @media only screen and(max-width:9991px) {
            .navbar-hover .show>.dropdown-toggle::after {
                transform: rotate(-90deg)
            }
        }

        @media only screen and (min-width:492px) {
            .navbar-hover .collapse ul li {
                position: relative;
            }

            .navbar-hover .collapse ul li:hover>ul {
                display: block
            }

            .navbar-hover .collapse ul ul {
                position: absolute;
                top: 100%;
                left: 0;
                min-width: 100px;
                display: none
            }

            .navbar-hover .collapse ul ul ul {
                position: absolute;
                top: 0;
                left: 100%;
                min-width: 200px;
                display: none
            }
            .navbar-nav > li{
                padding-left:3px!important;
                margin-right:3px!important;
            }
            .vertical-menu a {
            background-color: #fff;
            color: #000;
            display: block;
            padding: 12px;
            text-decoration: none;
        }

        .vertical-menu a:hover {
            background-color: red;
            color: #fff;
        }
        .vertical-menu a.active {
            background-color: red;
            color: #fff;
        }



        </style>
       
</body>
</html>