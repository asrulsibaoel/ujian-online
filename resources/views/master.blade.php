<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    @yield('title')

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('public/admin/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/font-awesome/css/font-awesome.min.css')}}">
    {{--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}
    <link rel="stylesheet" href="{{asset('public/admin/css/master.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/css/skins/skin-purple.css')}}">
    <script src="{{asset('public/admin/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <script src="{{asset('public/admin/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/admin/js/app.min.js')}}"></script>
    <script src="{{asset('public/admin/js/helpers.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('public/front/assets/wizard/css/smart_wizard.css')}}">
    <script src="{{asset('public/front/assets/wizard/js/jquery.smartWizard.js')}}"></script>
    <script src="{{asset('public/front/assets/countdown/jquery.plugin.js') }}"></script>
    <script src="{{asset('public/front/assets/countdown/jquery.countdown.js')}}"></script>
    <style>
        .btn {
            border-radius: 0px;
            font-size: 14px;
            margin-top: 5px;
        }

        .btn-block {
            width: 95%;
        }

        .btn-x {
            margin-top: 10px;
        }

        .color1 {
            background-color: #f6416c;
            color: white;
        }

        .color2 {
            background-color: #3bb873;
            color: white;
        }

        .user-panel {
            background: url("<?php echo asset('/public/admin/img/header.jpg'); ?>");
        }

        #cssload {
            background: url('<?php echo asset('public/admin/img/load.gif');?>') no-repeat center;
            background-color: rgba(0, 0, 0, 0.05);
            width: 100%;
            height: 100%;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
        }
    </style>
    @yield('css')

</head>
<div id='cssload'/>
</div>
<body class="hold-transition skin-purple sidebar-mini">

<div class="wrapper">
    <header class="main-header">
        <a href="index2.html" class="logo">
            <span class="logo-mini"></span>
            <span class="logo-lg">SMK INFOKOM</span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation">

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="log-as">Logged as {{Auth::admin()->get()->fullname}}</span>
                        </a>
                    </li>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs"><i class="fa fa-user"></i>&nbsp;&nbsp;<i
                                        class="fa fa-caret-down"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="{{asset('/public/admin/img/user2-160x160.jpg')}}" class="img-circle"
                                     alt="User Image">
                                <p>
                                    {{Auth::admin()->get()->fullname}}
                                    <small>- {{Auth::admin()->get()->level}} -</small>
                                </p>
                            </li>
                            <!-- Menu
                            <li class="user-body">
                              <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                              </div>
                              <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                              </div>
                              <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                              </div>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <!--
                                  <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Settings</a>
                                  </div>-->
                                <div class="pull-right">
                                    <a href="{{url('index/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('public/admin/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{Auth::admin()->get()->fullname}}</p>
                    <a href="#"><i class="fa fa-group"></i> {{Auth::admin()->get()->level}}</a>
                </div>
            </div>

            <!-- search form (Optional)
            <form action="#" method="get" class="sidebar-form">
              <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </form>
            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">Main navigation</li>
                <li><a href="{{url('index/dashboard')}}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-group"></i> <span>Manajemen User</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('index/manajemen/siswa')}}">Manajemen Siswa</a></li>
                        <!--<li><a href="#">Manajemen Guru</a></li>-->
                    </ul>
                </li>


                <li class="treeview">
                    <a href="#"><i class="fa fa-hashtag"></i> <span>Manajemen Ujian</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('index/manajemen/soal')}}"><span>Manajemen Soal Ujian</span></a></li>
                        <li><a href="{{url('index/manajemen/ujian')}}"></i> <span>Manajemen Mata Ujian</span></a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-briefcase"></i> <span>Master data</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('index/manajemen/mapel')}}"><span>Manajemen Mata Pelajaran</span></a></li>
                        <li><a href="{{url('index/manajemen/jurusan')}}"><span>Manajemen Jurusan</span></a></li>
                    <!--
            <li><a href="{{url('index/manajemen/kelas')}}"> <span>Manajemen Kelas</span></a></li>
            <li><a href="#"><span>Manajemen Jurusan</span></a></li>-->
                    </ul>
                </li>
                <!--
                <li><a href="#"><i class="fa fa-cog"></i> <span>Pengaturan</span></a></li>
                -->
            </ul>
            <div style="margin-top:20px;color:white" align="center">
                Technical Support
                <p>
                    <br>
                    <span style="font-size:11px;">Rifki alfaridzi</span><br>
                    <a href="ymsgr:sendIM?rifki.alfaridzi"><img
                                src="http://opi.yahoo.com/online?u=rifki.alfaridzi&amp;m=g&amp;t=1&amp;l=us" alt=""
                                border="0"> </a><br>
                    <a href="ymsgr:sendIM?rifki.alfaridzi"><i class="fa fa-mail"></i> </a><br>
                </p></div>
        </section>
    </aside>
    <div class="content-wrapper">
        <section class="content-header">

            @yield('text-info')

        </section>

        <section class="content">
            <div class="container-fluid">
                @include('flash::message')
            </div>


            @yield('content')

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            SMK INFORMATIKA DAN TELEKOMUNIKASI BOGOR
        </div>
        <!-- Default to the left -->
        Made with <i class="fa fa-music text-danger"></i> and <i class="fa fa-heart text-danger"></i> from bogor,
        indonesia
    </footer>
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->
</body>

@yield('javascript')
<script type='text/javascript'>
    $(window).bind("load", function () {
        $("#cssload").fadeOut(1e3)
    });
</script>
</html>


 