<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Laracraft - @yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('laracraft/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('laracraft/css/style.css') }}">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    @section('sidebar')
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">LARACRAFT</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Help</a></li>
              </ul>
            </div>
          </div>
        </nav>
    @show

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
        <h3 class="sub-header">Project</h3>
          <ul class="nav nav-sidebar">
            <li class="{{ Route::current()->getName() == 'laracraft-dashboard' ? 'active' : '' }}"><a href="{{ URL::to('laracraft/dashboard') }}">Dashboard <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Todo</a></li>
          </ul>
          <h3 class="sub-header">Tools</h3>
          <ul class="nav nav-sidebar">
            <li class="{{ Route::current()->getName() == 'laracraft-creative' ? 'active' : '' }}"><a href="{{ URL::to('laracraft/creative') }}">Creative</a></li>
            <li class="{{ Route::current()->getName() == 'laracraft-composer' ? 'active' : '' }}"><a href="{{ URL::to('laracraft/composer') }}">Composer</a></li>
            <li class="{{ Route::current()->getName() == 'laracraft-package' ? 'active' : '' }}"><a href="{{ URL::to('laracraft/package') }}">Package</a></li>
            <li class="{{ Route::current()->getName() == 'laracraft-backups' ? 'active' : '' }}"><a href="{{ URL::to('laracraft/backups') }}">Backups</a></li>
            <li><a class="{{ Route::current()->getName() == 'laracraft-database' ? 'active' : '' }}" href="{{ URL::to('laracraft/database') }}">Database</a></li>
            <!-- <li><a href="#">Git</a></li> -->
          </ul>
          <h3 class="sub-header">Assets</h3>
          <ul class="nav nav-sidebar">
            <li><a href="#">Auth</a></li>
            <li><a href="#">CDNJS</a></li>
          </ul>
          <h3 class="sub-header">Help</h3>
          <ul class="nav nav-sidebar">
            <li><a href="https://laravel.com/docs/5.2" target="_blank">Laravel 5.2</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        @yield('content')

        
    </div>
    <div class="col-md-10 col-lg-10 col-md-offset-2 valkyrie-console" id="valkyrie-console-content" vis="small">
          <div class="valkyrie-console-action">
            <span> Console Log </span>
            <a href="#" id="valkyrie-expand" class="valkyrie-console-toggler">Toggle</a>
          </div>
          <div class="valkyrie-console-log-container">
          <div id="valkyrie-console-log" class="valkyrie-console-log">
            <ul id="valkyrie-console-log-data">
              <li v-repeat="cdata">
                @{{data}}
              </li>
            </ul>
          </div>
          </div>
    </div>


    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="{{ asset('laracraft/js/bootstrap.min.js') }}"></script>

    <!-- Valkyrie Console JS -->
    <script type="text/javascript">
      $( "#valkyrie-console-content #valkyrie-expand" ).on( "click", function() {
            $Vconsole =  $( "#valkyrie-console-content");
            $Vconsole.toggleClass('full-height');
      });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.16/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.5/socket.io.min.js"></script>

    <script type="text/javascript">

        var socket = io('http://{{ $_SERVER["HTTP_HOST"] }}:3000');
        new Vue({
            el: '#valkyrie-console-log-data',

            data: {
                cdata: []
            },

            ready: function() {
                socket.on('laracraft:Valkyrie\\Laracraft\\Events\\ProcessStatus', function(data) {
                    console.log(data);
                    this.cdata.push(data);
                }.bind(this));
            }
        });
    </script>
    @section('js')
    @show
</body>
</html>