<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="{{ url('/gentelella') }}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('/gentelella') }}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ url('/gentelella') }}/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="{{ url('/gentelella') }}/build/css/custom.min.css" rel="stylesheet">
    <link href="{{ url('/gentelella') }}/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('/gentelella') }}/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css"
        rel="stylesheet">
    <link href="{{ url('/gentelella') }}/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css"
        rel="stylesheet">
    <link href="{{ url('/gentelella') }}/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css"
        rel="stylesheet">
    <link href="{{ url('/gentelella') }}/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="#" class="site_title"><i class="fa fa-hospital-o"></i> <span>Klinik
                                ABC</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="{{ url('/gentelella/production') }}/images/img.jpg" alt="..."
                                class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <h2>{{ Auth::user()->name }}</h2>
                            <span>{{ Auth::user()->role }}</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <br />
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                                <li><a><i class="fa fa-database"></i> Master <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ url('kategori') }}">Kategori Obat</a></li>
                                        <li><a href="{{ url('unit') }}">Satuan Obat</a></li>
                                        <li><a href="{{ url('supplier') }}">Supplier</a></li>
                                        <li><a href="#">Obat</a></li>

                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                    id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ url('/gentelella/production') }}/images/img.jpg" alt="">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#"> Profile</a>
                                    <a class="dropdown-item" href="{{ url('logout') }}"><i
                                            class="fa fa-sign-out pull-right"></i>
                                        Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
