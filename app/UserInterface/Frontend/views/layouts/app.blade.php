<!DOCTYPE html>
<!-- saved from url=(0055) -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="shortcut icon" href="http://www.jasny.net/bootstrap/assets/ico/favicon.png"> -->

  <title>iLiBookDelivery</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
  
  <!-- Custom CSS -->
  <link href="{{ url('/frontend_public/css/layout.css') }}" rel="stylesheet">

  @yield('css')

  </head>

  <body>
    <div class="navmenu navmenu-default navmenu-fixed-left">
      <a class="navmenu-brand" href="{{ url('/frontend') }}">iLiBookDelivery</a>
      <ul class="nav navmenu-nav">
        <li><a href="{{ url('/frontend/') }}">Home</a></li>
        <li><a href="#">About</a></li>
      </ul>
      <ul class="nav navmenu-nav">
        <!-- Authentication Links -->
        @if (Auth::guest())
            <li><a href="{{ url('/frontend/login') }}">Login</a></li>
            <li><a href="{{ url('/frontend/register') }}">Register</a></li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu navmenu-nav" role="menu">
                    <li><a href="{{ url('/frontend/profile') }}"><i class="fa fa-btn fa-user"></i> Profile</a></li>
                    <li><a href="{{ url('/frontend/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
                </ul>
            </li>
        @endif

      </ul>
    </div>

    <div class="canvas">
      <div class="navbar navbar-default navbar-fixed-top" style="width: 100%;">
        <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-recalc="false" data-target=".navmenu" data-canvas=".canvas">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <br>
        @yield('content')
    </div>
    

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- Bootstrap core JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
    <script src="{{ url('/frontend_public/js/layout.js') }}" type="text/javascript"></script>

    @yield('scripts')

</body></html>