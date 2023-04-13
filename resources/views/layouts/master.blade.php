<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Unidel Carriers - @yield('title')</title>
        <!-- Styles -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="{{asset('plugins/materialize/css/materialize.min.css')}}"/>
        <!-- Theme Styles -->
        @stack('styles')
        <link href="{{asset('css/alpha.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    <div class="loader-bg"></div>
        <div class="loader">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-teal lighten-1">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mn-content fixed-sidebar">
            @section('header')
            <header class="mn-header navbar-fixed">
                <nav class="cyan darken-1">
                    <div class="nav-wrapper row">
                        <section class="material-design-hamburger navigation-toggle">
                            <a href="#" data-activates="slide-out" class="show-on-large material-design-hamburger__icon reverse-icon">
                                <span class="material-design-hamburger__layer"></span>
                            </a>
                        </section>
                        <div class="header-title col s3">
                            <span class="chapter-title">Transport Management System</span>
                        </div>
                        <ul class="right col s9 m3 nav-right-menu">
                            @if (isset(Auth::user()->email))
                                <li>
                                    <a href="{{url('/auth/logout')}}">Logout</a>
                                </li>
                                <li>
                                    <strong>{{Auth::user()->email}}</strong>
                                </li>
                            @else
                                <script>window.location = "/auth";</script>
                            @endif
                        </ul>
                    </div>
                </nav>
            </header>
            @show
            @section('sidebar')
            <aside id="slide-out" class="side-nav white fixed">
                <div class="side-nav-wrapper">
                    <div class="sidebar-profile">
                        <div class="sidebar-profile-image">
                            <img src="{{asset('images/profile-image.png')}}" class="circle" alt="">
                        </div>
                        <div class="sidebar-profile-info">
                            @if (isset(Auth::user()->email))
                                <p>{{Auth::user()->name}}</p>
                                <mailto:span>{{Auth::user()->email}}</span>
                            @endif
                        </div>
                    </div>
                    <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
                        <li class="no-padding active">
                            <a class="waves-effect waves-grey active" href="{{url('/dashboard')}}">Dashboard</a>
                        </li>
                        <li class="no-padding">
                            <a href="{{url('/order/all')}}">UC Orders</a>
                        </li>
                        <li class="no-padding">
                            <a href="{{url('transporter/list')}}">Transporters</a>
                        </li>
                        <li class="no-padding">
                            <a href="{{url('client/list')}}">Clients</a>
                        </li>
                        <li class="no-padding">
                            <a href="{{url('user/customer')}}">Suppliers</a>
                        </li>
                        <li class="no-padding">
                            <a class="collapsible-header waves-effect waves-grey" href="{{url('/loadAddrs')}}">Load Addresses</a>
                        </li>
                        <li class="no-padding">
                            <a class="collapsible-header waves-effect waves-grey" href="{{url('/offloadAddrs')}}">Offload Addresses</a>
                        </li>
                        <li class="no-padding">
                            <a href="{{route('xerequest.index')}}">XE Request</a>
                        </li>
                        <li class="no-padding">
                            <a href="{{route('manifest.index')}}">Manifests</a>
                        </li>
                        <li class="no-padding">
                            <a href="{{url('/tracking-report')}}">Tracking-Report</a>
                        </li>
                        <li class="no-padding">
                            <a href="{{url('/tracking-general')}}">Tracking-General</a>
                        </li>
                        <li class="no-padding">
                            <a href="{{route('container.index')}}">Containers</a>
                        </li>
                        @if (Auth::user()->level == 1 || Auth::user()->level == 2)
                        <li class="no-padding">
                            <a href="{{url('user/admin')}}">Administrators</a>
                        </li>
                        @endif
                    </ul>
                    <div class="footer">
                        <p class="copyright">Unidel Carriers ©</p>
                        <a href="#!">Privacy</a> &amp; <a href="#!">Terms</a>
                    </div>
                </div>
            </aside>
            @show
            <main class="mn-inner">
                @yield('content')
            </main>
        </div>
        <script src="{{asset('plugins/jquery/jquery-2.2.0.min.js')}}"></script>
        <script src="{{asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
        <script src="{{asset('plugins/materialize/js/materialize.min.js')}}"></script>
        <script src="{{asset('plugins/material-preloader/js/materialPreloader.min.js')}}"></script>
        <script src="{{asset('plugins/jquery-blockui/jquery.blockui.js')}}"></script>
        <script src="{{asset('js/alpha.min.js')}}"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </body>
@stack('javascript')
</html>
