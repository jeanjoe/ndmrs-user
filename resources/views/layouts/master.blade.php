<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('vendor/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="sidebar-fixed header-fixed">
<div class="page-wrapper">
    <nav class="navbar page-header bg-light">
        <a href="#" class="btn btn-link sidebar-mobile-toggle d-md-none mr-auto">
            <i class="fa fa-bars"></i>
        </a>

        <a class="navbar-brand" href="{{ route('dashboard') }}">
            NDRMS - 2018
            <!-- <img src="{{ asset('imgs/logo.png') }}" alt="logo"> -->
        </a>

        <a href="#" class="btn btn-link sidebar-toggle d-md-down-none">
            <i class="fa fa-bars"></i>
        </a>

        <a href="{{ route('settings') }}" class="nav-item btn btn-info btn-sm">
          {{ strtoupper($currentUser->healthFacility->name .' - '. $currentUser->healthFacility->level) }}
        </a>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item d-md-down-none">
                <a href="#">
                    <i class="fa fa-bell"></i>
                    <span class="badge badge-pill badge-warning">5</span>
                </a>
            </li>

            <li class="nav-item d-md-down-none">
                <a href="#">
                    <i class="fa fa-envelope-open"></i>
                    <span class="badge badge-pill badge-warning">5</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('imgs/avatar-1.png') }}" class="avatar avatar-sm" alt="logo">
                    <span class="small ml-1 d-md-down-none">{{ Auth::user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header">My Account</div>

                    <a href="#" class="dropdown-item">
                        <i class="fa fa-user"></i> Profile
                    </a>

                    <a href="#" class="dropdown-item">
                        <i class="fa fa-bell"></i> Notifications
                    </a>

                    <a href="{{ route('settings') }}" class="dropdown-item">
                        <i class="fa fa-wrench"></i> Settings
                    </a>

                    <a href="{{ route('logout') }}" class="dropdown-item"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <i class="fa fa-lock"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>

                </div>
            </li>
        </ul>
    </nav>

    <div class="main-container">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">

                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link active">
                            <i class="icon icon-speedometer"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="icon icon-target"></i> Health Facilities <i class="fa fa-caret-left"></i>
                        </a>

                        <ul class="nav-dropdown-items">

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon icon-target"></i> Referrals
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('hospitals') }}" class="nav-link">
                                    <i class="icon icon-target"></i> Hospitals
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon icon-target"></i> Health Centre II
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon icon-target"></i> Health Centre III
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon icon-target"></i> Health Centre IV
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon icon-target"></i> View All
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="icon icon-graph"></i> Stock Management <i class="fa fa-caret-left"></i>
                        </a>

                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="{{ route('stocks.index') }}" class="nav-link">
                                    <i class="icon icon-graph"></i> Add Stock
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon icon-graph"></i> Stock Card
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="icon icon-energy"></i> Stock Cards <i class="fa fa-caret-left"></i>
                        </a>

                        <ul class="nav-dropdown-items">

                            <li class="nav-item">
                                <a href="{{ route('stock-books.index') }}" class="nav-link">
                                    <i class="icon icon-book-open"></i> Stock Book
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon icon-graph"></i> Stock Reports
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('stock-cards.index') }}" class="nav-link">
                                    <i class="icon icon-eye"></i> All Stock Cards
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="icon icon-graph"></i> Statistics <i class="fa fa-caret-left"></i>
                        </a>

                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="{{ route('reports') }}" class="nav-link">
                                    <i class="icon icon-graph"></i> Reports
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('orders.index') }}" class="nav-link">
                            <i class="icon icon-cloud-download"></i> Orders
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('settings') }}" class="nav-link">
                            <i class="icon icon-settings"></i> General Settings
                        </a>
                    </li>

                    <li class="nav-title">More</li>

                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="icon icon-umbrella"></i>More Pages <i class="fa fa-caret-left"></i>
                        </a>

                        <ul class="nav-dropdown-items">

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon icon-umbrella"></i> Invoice
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('settings') }}" class="nav-link">
                                    <i class="icon icon-umbrella"></i> Settings
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="content">
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/popper.js/popper.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script src="{{ asset('vendor/chart.js/chart.min.js') }}"></script>
<script src="{{ asset('js/carbon.js') }}"></script>
<script src="{{ asset('js/demo.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#dataTable').DataTable();
} );
</script>
@yield('script')
</body>
</html>
