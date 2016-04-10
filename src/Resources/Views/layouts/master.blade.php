<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Laracraft - @yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('laracraft/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('laracraft/css/animate.css') }}">
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
              </ul>
            </div>
          </div>
        </nav>
    @show

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">

          <button type="button" class="btn btn-danger" id="run-laracraft-server" style="display:none">Run Laracraft Server</button>

          <h3 class="sub-header">Project</h3>
          <ul class="nav nav-sidebar">
            <li class="{{ Route::current()->getName() == 'laracraft-dashboard' ? 'active' : '' }}">
                <a href="{{ URL::to('laracraft/dashboard') }}">
                  <i class="livicon" data-name="home" data-size="18" data-c="#353030" data-hc="#353030" data-loop="true"></i> Dashboard
                </a>
            </li>
          </ul>

          <h3 class="sub-header">Base</h3>
          <ul class="nav nav-sidebar">
            <li class="{{ Route::current()->getName() == 'laracraft-creative' ? 'active' : '' }}">
              <a href="{{ URL::to('laracraft/creative') }}">
                <i class="livicon" data-name="lab" data-size="18" data-c="#353030" data-hc="#353030" data-loop="true"></i> Creative
              </a>
            </li>
            <li class="{{ Route::current()->getName() == 'laracraft-base-controller' ? 'active' : '' }}">
              <a href="{{ URL::to('laracraft/base/controller') }}">
                <i class="livicon" data-name="globe" data-size="18" data-c="#353030" data-hc="#353030" data-loop="true"></i> Controller
              </a>
            </li>
            <li class="{{ Route::current()->getName() == 'laracraft-base-model' ? 'active' : '' }}">
              <a href="{{ URL::to('laracraft/base/model') }}">
                <i class="livicon" data-name="globe" data-size="18" data-c="#353030" data-hc="#353030" data-loop="true"></i> Model
              </a>
            </li>
            <li class="{{ Route::current()->getName() == 'laracraft-base-migration' ? 'active' : '' }}">
              <a href="{{ URL::to('laracraft/base/migration') }}">
                <i class="livicon" data-name="globe" data-size="18" data-c="#353030" data-hc="#353030" data-loop="true"></i> Migration
              </a>
            </li>
            <li class="{{ Route::current()->getName() == 'laracraft-base-route' ? 'active' : '' }}">
              <a href="{{ URL::to('laracraft/base/route') }}">
                <i class="livicon" data-name="globe" data-size="18" data-c="#353030" data-hc="#353030" data-loop="true"></i> Route TODO
              </a>
            </li>
          </ul>

          <h3 class="sub-header">Tools</h3>
          <ul class="nav nav-sidebar">
            <li class="{{ Route::current()->getName() == 'laracraft-composer' ? 'active' : '' }}">
              <a href="{{ URL::to('laracraft/composer') }}">
                <i class="livicon" data-name="gear" data-size="18" data-c="#353030" data-hc="#353030" data-loop="true"></i> Composer
              </a>
            </li>
            <li class="{{ Route::current()->getName() == 'laracraft-package' ? 'active' : '' }}">
              <a href="{{ URL::to('laracraft/package') }}">
                <i class="livicon" data-name="checked-off" data-size="18" data-c="#353030" data-hc="#353030" data-loop="true"></i> Package
              </a>
            </li>
            <li class="{{ Route::current()->getName() == 'laracraft-backups' ? 'active' : '' }}">
              <a href="{{ URL::to('laracraft/backups') }}">
                <i class="livicon" data-name="download" data-size="18" data-c="#353030" data-hc="#353030" data-loop="true"></i> Backups
              </a>
            </li>
            <li class="{{ Route::current()->getName() == 'laracraft-database' ? 'active' : '' }}">
              <a href="{{ URL::to('laracraft/database') }}">
                <i class="livicon" data-name="inbox" data-size="18" data-c="#353030" data-hc="#353030" data-loop="true"></i> Database
              </a>
            </li>

            <li class="{{ Route::current()->getName() == 'laracraft-logs' ? 'active' : '' }}">
              <a href="{{ URL::to('laracraft/logs') }}">
                <i class="livicon" data-name="bug" data-size="18" data-c="#353030" data-hc="#353030" data-loop="true"></i> Laravel Log
              </a>
            </li>
          </ul>

          <h3 class="sub-header">Configurations</h3>
          <ul class="nav nav-sidebar">
            <li class="{{ Route::current()->getName() == 'laracraft-config-env' ? 'active' : '' }}">
              <a href="{{ URL::to('laracraft/config/env') }}">
                <i class="livicon" data-name="wrench" data-size="18" data-c="#353030" data-hc="#353030" data-loop="true"></i> Environment
              </a>
            </li>
            <li class="{{ Route::current()->getName() == 'laracraft-config-app' ? 'active' : '' }}"><a href="{{ URL::to('laracraft/config/env') }}">App TODO</a></li>
          </ul>

          <h3 class="sub-header">Help</h3>
          <ul class="nav nav-sidebar">
            <li>
              <a href="https://laravel.com/docs/5.2" target="_blank">
                <i class="livicon" data-name="info" data-size="18" data-c="#353030" data-hc="#353030" data-loop="true"></i> Laravel 5.2
              </a>
            </li>
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

    <!--livicons-->
    <script src="{{ asset('laracraft/js/livicons/minified/raphael-min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('laracraft/js/livicons/minified/livicons-1.4.min.js') }}" type="text/javascript"></script>

    <!--notify-->
    <script src="{{ asset('laracraft/js/bootstrap-notify-3.1.3/dist/bootstrap-notify.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $.notifyDefaults({
                // settings
                element: 'body',
                position: null,
                type: "info",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                    from: "top",
                    align: "center"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 2000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class',
                template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                    '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                    '<span data-notify="icon"></span> ' +
                    '<span data-notify="title">{1}</span> ' +
                    '<span data-notify="message">{2}</span>' +
                    '<div class="progress" data-notify="progressbar">' +
                        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                    '</div>' +
                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>' 
        });
    </script>


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

           $.ajax({
              url: 'http://{{ $_SERVER["HTTP_HOST"] }}:3000',
              success: function(result){
                  $('#run-laracraft-server').hide();
              },
              error: function(result){
                  $('#run-laracraft-server').show();
              }
           });


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

    <script type="text/javascript">
        $(document).on('click', '#run-laracraft-server', function (e) {
            e.preventDefault();

            $.ajax({
              type: "GET",
              url: '/laracraft/server/start'
            });

            location.reload();
            return false;
        });
    </script>

    @section('js')
    @show
</body>
</html>