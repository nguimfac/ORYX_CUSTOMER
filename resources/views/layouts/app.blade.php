<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Optimus clients</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="icon" href="{{asset ('images/OpClients.png')}}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/my_js.js') }}" defer></script>
    <script src="{{ asset('js/animsition.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/countdowntime.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://demo.themefisher.com/classimax/plugins/bootstrap/popper.min.js"></script>
    <script src="https://demo.themefisher.com/classimax/plugins/bootstrap/bootstrap.min.js"></script>

    <script src="{{asset('js/datables.js')}}"></script>
    <script src="{{asset('js/dataTables.responsive.js')}}"></script>
    <script src="{{asset('js/vfs_fonts.js')}}"></script>
    <script src="{{asset('js/datables.js')}}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap.css') }}" rel="stylesheet">



    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icon-font.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap.min.css') }}" rel="stylesheet">
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


    <link rel="stylesheet" href="{{asset('css/datables.css')}}">
    <!-- Styles -->

    <link href="https://demo.themefisher.com/classimax/plugins/font-awesome/css/font-awesome.min.css " rel="stylesheet ">

    <link rel="stylesheet " href="https://demo.themefisher.com/classimax/plugins/slick/slick.css ">
    <link rel="stylesheet " href="https://demo.themefisher.com/classimax/plugins/slick/slick-theme.css ">
    <link rel="stylesheet " href="{{asset( 'css/Style.css')}} ">
    <!-- Styles -->
    <link href="{{ asset( 'css/app.css') }} " rel="stylesheet ">
</head>

<body>
    @include('sweetalert::alert')
    <div id=" ">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm ">
            <div class="container ">
                <a class="navbar-brand " href="{{ url( 'home/') }} ">
                    <img class=" " src="{{asset ( 'images/op.png')}} " width="75 "> <span class="mt-4 "> <strong>OPTIMUS CLIENTS</strong> </span>
                </a>
                <button class="navbar-toggler " type="button " data-toggle="collapse " data-target="#navbarSupportedContent " aria-controls="navbarSupportedContent " aria-expanded="false " aria-label="{{ __( 'Toggle navigation') }} ">
                    <span class="navbar-toggler-icon "></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent ">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto ">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto ">
                        <!-- Authentication Links -->
                        @guest @if (Route::has('login'))
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route( 'login') }} ">{{ __('Login') }}</a>
                        </li>
                        @endif @if (Route::has('register'))
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route( 'register') }} ">{{ __('Register') }}</a>
                        </li>
                        @endif @else
                        <li class="nav-item active ">
                            <a class="nav-link " href="home ">Acceuil</a>
                        </li>

                        <li class="nav-item dropdown dropdown-slide @@dashboard ">
                            <a class="nav-link dropdown-toggle " data-toggle=" " href="#! ">Menu</span>
								</a>

                            <!-- Dropdown list -->
                            <ul class="dropdown-menu ">
                                <li><a class="dropdown-item @@dashboardPage " href="{{url( 'software')}} ">Logiciel</a></li>
                                <li class="dropdown dropdown-submenu dropright ">
                                    <a class="dropdown-item dropdown-toggle " href="#! " id="dropdown0501 " role="button " data-toggle="dropdown " aria-haspopup="true " aria-expanded="false ">Souscription</a>

                                    <ul class="dropdown-menu " aria-labelledby="dropdown0501 ">
                                        <li><a class="dropdown-item " href="{{url( 'prospect')}} ">Prospect</a></li>
                                        <li>
                                            <a class="dropdown-item " href="{{url( 'souscription')}} ">Client</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown dropdown-submenu dropright ">
                                    <a class="dropdown-item dropdown-toggle " href="#! " id="dropdown0501 " role="button " data-toggle="dropdown " aria-haspopup="true " aria-expanded="false ">Service apres ventes</a>

                                    <ul class="dropdown-menu " aria-labelledby="dropdown0501 ">
                                        <li><a class="dropdown-item " href="{{url( 'sav')}} ">Reclammation</a></li>
                                        <li>
                                            <a class="dropdown-item " href="{{url( 'sav')}} ">Suggestion</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown dropdown-slide @@dashboard ">
                            <a class="nav-link dropdown-toggle " data-toggle=" " href=" ">{{Auth::user()->name}} </span>
                                <img src="{{asset( 'images/user.png')}} " width="25 " />	</a>

                            <!-- Dropdown list -->
                            <ul class="dropdown-menu ">
                                <li><a class="dropdown-item @@dashboardPage " href="destroysesssion ">Deconnecter   <i class="fa fa-sign-out " aria-hidden="true "></i>
                                </a></li>


                            </ul>
                        </li>




                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4 ">
            @yield('content')
        </main>
        <div>
            {{View::make('footer')}}
        </div>
    </div>
</body>

</html>