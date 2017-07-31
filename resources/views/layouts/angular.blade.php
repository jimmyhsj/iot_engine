<!DOCTYPE html>
<html lang="en" ng-app="iotApp">
<head>
  <title>IoT Engine</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/font-awesome.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="/js/bower_components/angular/angular.min.js"></script>
  <script type="text/javascript" src="/js/bower_components/angular/angular-route.min.js"></script>
  <script type="text/javascript" src="/js/bower_components/angular/angular-animate.min.js"></script>
  <script type="text/javascript" src="/app/app.js"></script>
  <script type="text/javascript" src="/app/controllers/ReportsController.js"></script>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Open Sans', serif;
    }
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    .row.content {height: 450px}

    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
        <a class="navbar-brand" href="#">IoT Engine</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="/dashboard"><i class="fa fa-tachometer fa-lg" aria-hidden="true"></i> Reports</a></li>
          {{-- <li class="active"><a href="/iotconnect"><i class="fa fa-cog fa-lg" aria-hidden="true"></i> AWS IoT Connectivity</a></li> --}}
        </ul>
        <ul class="nav navbar-nav navbar-right">
          @if (!Auth::user())
          <li>
            <a href="{{ url('/login') }}">Login</a>
          </li>
          <li>
            <a href="{{ url('/register') }}">Register</a>
          </li>
          @endif
          @if (Auth::user())
          <li>
            <a href="{{ url('/logout') }}">Logout</a>
          </li>
          @endif
        </div>
      </div>
    </nav>
    <div class="row">
      <div class="col-md-10 col-xs-12 col-md-offset-1">
        @yield('content')
      </div>
    </div>
  </body>
  </html>