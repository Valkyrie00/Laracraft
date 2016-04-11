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
    <h1 class="sub-header">Route</h1>
    <ol class="breadcrumb">
        <li>Base</li>
        <li class="active">Route</li>
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
                            <strong>New Route</strong>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th>Type</th>
                                    <th>Route Name</th>
                                    <th>As</th>
                                    <th>Controller</th>
                                    <th>Method</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-md-1"><select name="route[route][type]"><option value="get">GET</option><option value="post">POST</option></select></td>
                                        <td class="col-md-3"><input type="text" value="" class="form-control" name="route[route][name]" placeholder="Route name"></td>
                                        <td class="col-md-3"><input type="text" value="" class="form-control" name="route[route][as]" placeholder="Route as"></td>
                                        <td class="col-md-3">
                                            <select name="route[route][controller]" id="getControllers">
                                                @foreach($controllers as $controller)
                                                    <option value="{{ $controller->getFilename() }}" data-path="{{ $controller->getPathname () }}">{{ $controller->getFilename() }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="col-md-3"><select name="route[route][method]"><option value="get">GET</option></select></td>
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
                            <strong>New resource</strong>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th>Model Name</th>
                                    <th>Model Table</th>
                                    <th>Destination</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-md-3"><input type="text" value="" class="form-control" name="model[model_name]" id="model_name" placeholder="Model Name"></td>
                                        <td class="col-md-3"><input type="text" value="" class="form-control" name="model[model_table]" id="model_table" placeholder="Model Table"></td>
                                        <td class="col-md-6">app/<strong><span id="model_name_replace">MODEL-NAME</span></strong>.php</td>
                                        <td class="col-md-3"><button type="submit" class="btn btn-success">Create!</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <strong>New Group</strong>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th>Model Name</th>
                                    <th>Model Table</th>
                                    <th>Destination</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-md-3"><input type="text" value="" class="form-control" name="model[model_name]" id="model_name" placeholder="Model Name"></td>
                                        <td class="col-md-3"><input type="text" value="" class="form-control" name="model[model_table]" id="model_table" placeholder="Model Table"></td>
                                        <td class="col-md-6">app/<strong><span id="model_name_replace">MODEL-NAME</span></strong>.php</td>
                                        <td class="col-md-3"><button type="submit" class="btn btn-success">Create!</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

 

</section>
@endsection



@section('js')

<script type="text/javascript">

$('#getControllers').on('change', function() {
    var path = $(this).find(':selected').data('path');

   $.ajax({
      url: '/laracraft/code/getmethods',
      type: 'GET',
      data: { controller_path: path }
    })
    .done(function( data ) {
        console.log(data);
    });
});
   
</script>


@if(Session::has('success'))
  <script type="text/javascript">
    $.notify({ message: "Operation Successful!" },{ type: 'success' });
  </script>
@endif

@endsection