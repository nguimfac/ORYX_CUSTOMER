<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/my_js.js') }}" defer></script>
    <script src="{{ asset('js/animsition.min.js') }}" ></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" ></script>
    <script src="{{ asset('js/countdowntime.js') }}" ></script>
    <script src="{{ asset('js/daterangepicker.js') }}" ></script>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}" ></script>
    <script src="{{ asset('js/main.js') }}" ></script>
    <script src="{{ asset('js/moment.min.js') }}" ></script>
    <script src="{{ asset('js/popper.js') }}" ></script>
    <script src="{{ asset('js/select2.min.js') }}" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://demo.themefisher.com/classimax/plugins/bootstrap/popper.min.js"></script>
    <script src="https://demo.themefisher.com/classimax/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="https://demo.themefisher.com/classimax/plugins/bootstrap/bootstrap-slider.js"></script>
    <script src="https://demo.themefisher.com/classimax/plugins/tether/js/tether.min.js"></script>
    <script src="https://demo.themefisher.com/classimax/plugins/raty/jquery.raty-fa.js"></script>
    <script src="https://demo.themefisher.com/classimax/plugins/slick/slick.min.js"></script>
    <script src="https://demo.themefisher.com/classimax/plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU"></script>
    <script src="https://demo.themefisher.com/classimax/plugins/google-map/map.js"></script>
    <script src="https://demo.themefisher.com/classimax/js/script.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icon-font.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/hamburgers.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animsition.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/util.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my_style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fileinput.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fileinput-rtl.min.css') }}" rel="stylesheet">

    <!-- Styles -->

<link rel="stylesheet" href="https://demo.themefisher.com/classimax/plugins/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="https://demo.themefisher.com/classimax/plugins/bootstrap/bootstrap-slider.css">
  <link rel="stylesheet" href="https://demo.themefisher.com/classimax/plugins/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="https://demo.themefisher.com/classimax/plugins/slick/slick.css">
<link rel="stylesheet" href="https://demo.themefisher.com/classimax/plugins/slick/slick-theme.css">
<link rel="stylesheet" href="https://demo.themefisher.com/classimax/plugins/jquery-nice-select/css/nice-select.css">
 <link rel="stylesheet" href="https://demo.themefisher.com/classimax/css/style.css">    
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
@include('sweetalert::alert')
    <div id="">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('home/') }}">
                   <img src="{{asset ('images/logo_oryx.jpg')}}" width="50" alt="">   <span class="mt-4">CUSTOMER MANAGEMENT</span>
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

                        <li class="nav-item active">
								<a class="nav-link" href="home">Home</a>
							</li>

                        <li class="nav-item dropdown dropdown-slide @@dashboard">
								<a class="nav-link dropdown-toggle" data-toggle="" href="#!">Dashboard</span>
								</a>

								<!-- Dropdown list -->
								<ul class="dropdown-menu">
									<li><a class="dropdown-item @@dashboardPage" href="dashboard.html">Dashboard</a></li>
									<li><a class="dropdown-item @@dashboardMyAds" href="dashboard-my-ads.html">Dashboard My Ads</a></li>
									<li><a class="dropdown-item @@dashboardFavouriteAds" href="dashboard-favourite-ads.html">Dashboard Favourite Ads</a></li>
									<li><a class="dropdown-item @@dashboardArchivedAds" href="dashboard-archived-ads.html">Dashboard Archived Ads</a></li>
									<li><a class="dropdown-item @@dashboardPendingAds" href="dashboard-pending-ads.html">Dashboard Pending Ads</a></li>
									
									<li class="dropdown dropdown-submenu dropright">
										<a class="dropdown-item dropdown-toggle" href="#!" id="dropdown0501" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sub Menu</a>
					
										<ul class="dropdown-menu" aria-labelledby="dropdown0501">
											<li><a class="dropdown-item" href="index.html">Submenu 01</a></li>
											<li><a class="dropdown-item" href="index.html">Submenu 02</a></li>
										</ul>
									</li>
								</ul>
							</li>

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
                                </div>
                            </li>

                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
