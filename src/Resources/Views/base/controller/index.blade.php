@extends('laracraft.layouts.master')

@section('title', 'Controller')

@section('content')

<style type="text/css" media="screen">
    #editor { 
        width: 100%;
        height: 400px;
    }
</style>

<section class="content-header">
    <h1 class="sub-header">Controller</h1>
    <ol class="breadcrumb">
        <li>Base</li>
        <li class="active">Controller</li>
    </ol>

    <div class="alert alert-info" role="alert">
      <strong>Heads up!</strong> ....
    </div>
</section>

<!-- Main content -->
<section class="content">

    <form action="{{ URL::to('laracraft/creative/create') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <strong>New Controller</strong>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th>Controller Name</th>
                                    <th>Destination</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-md-3"><input type="text" value="" class="form-control" name="controller[controller_name]" id="controller_name" placeholder="Controller Name"></td>
                                        <td class="col-md-6">app/Http/Controllers/<strong><span id="controller_name_replace">CONTROLLER-NAME</span></strong>Controller.php</td>
                                        <td class="col-md-3"><button type="submit" class="btn btn-success">Create!</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <strong>Controllers</strong>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <table class="table">
                            <thead>
                              <tr>
                                <th>Controller</th>
                                <th>Created At</th>
                                <th>Size ( Kb )</th>
                                <th>Permission</th>
                                <th>Path</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($controllers as $controller)
                                <tr>
                                    <td class="col-md-3">{{ $controller->getFilename() }}</td>
                                    <td class="col-md-2">{{ date('Y-m-d H:i:s', $controller->getMTime()) }}</td>
                                    <td class="col-md-2">{{ number_format($controller->getSize() / 1024, 2) }}</td>
                                    <td class="col-md-2">{{ substr(sprintf('%o', $controller->getPerms()), -4) }}</td>
                                    <td class="col-md-3">{{ $controller->getPath() }}</td>
                                    <!-- <td class="col-md-6"><button type="submit" class="btn btn-primary">Edit</button></td> -->
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
<!--     <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <strong>Edit Controller</strong>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div id="editor">{{ file_get_contents('/home/vagrant/laracraft/app/Http/Controllers/IgenicoController.php') }}</div> 
                    </div>
                </div>
            </div>
        </div>
    </div> -->



</section>
@endsection



@section('js')

<script src="{{ asset('laracraft/js/ace/src/ace.js') }}" type="text/javascript" charset="utf-8"></script>
<script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.getSession().setMode("ace/mode/php");

    editor.commands.addCommand({
        name: "save",
        bindKey: {
            win: "Ctrl-S",
            mac: "Command-S",
            sender: "editor|cli"
        },
        exec: function() {
            saveFile();
        }
    });

    saveFile = function() {
        var contents = editor.getSession().getValue();
        var actionSave = '/laracraft/base/controller';

        $.ajax({
          url: actionSave,
          type: 'POST',
          data: { contents: contents }
        })
        .done(function( data ) {
            console.log(data);
            $.notify({ message: "Saved" },{ type: 'success' });
        });
    };

</script>

<script type="text/javascript">
    $("#controller_name").keyup(function() {
        $("#controller_name_replace").text( this.value );
    });
</script>


@if(Session::has('success'))
  <script type="text/javascript">
    $.notify({ message: "Operation Successful!" },{ type: 'success' });
  </script>
@endif

@endsection