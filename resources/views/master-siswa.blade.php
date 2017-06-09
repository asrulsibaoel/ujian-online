<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    @yield('title')

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('public/admin/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/css/master.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/css/skins/skin-purple.css')}}">
    <link rel="stylesheet" href="{{asset('public/front/assets/countdown/jquery.countdown.css')}}">
<style type="text/css">
#defaultCountdown { width: 240px; height: 45px; }
#pesan {
  display:none;
}
.hours {
  float: left;
}
.minutes {
  float: left;
}
.seconds {
  float: left;
}
.main-header > .navbar {
  margin-left: 400px;
}
.main-header .logo {
  width: 400px;
}
</style>
<script src="{{asset('public/front/jquery-1.js') }}"></script>
<script src="{{asset('public/admin/bootstrap/js/bootstrap.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('public/front/assets/wizard/css/smart_wizard.css')}}">
<script src="{{asset('public/admin/js/jquery.js')}}"></script>
<script src="{{asset('public/admin/js/jquery.simple.timer.js')}}"></script>
<script src="{{asset('public/front/assets/wizard/js/jquery.smartWizard.js')}}"></script>
<script src="{{asset('public/front/assets/countdown/jquery.plugin.js') }}"></script>

    @yield('css')

    </head>

    <body class="hold-transition skin-purple sidebar-mini">
    @if(Auth::user()->check())
      <header class="main-header">


<a href="#" class="logo">
          <span class="logo-mini"></span>
<span class="logo-lg"><div id="waktu"><div class="timer" id="timer" data-seconds-left=""></div></div></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                
                  <span class="hidden-xs">Logged as {{Auth::user()->get()->fullname}}</span>
                </a>
              </li>             
            </ul>
          </div>
        </nav>
      </header>
      @endif
      <div style="margin-top:5px" class="container-fluid">
                


        <div class="alert alert-success" id="pesan"> <!-- jika ada error, tampilkan -->
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Selamat Mengerjakan ^^
        </div>
      </div>

@yield('content')

        

  @yield('javascript')

  </html>