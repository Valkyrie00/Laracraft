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
    <h1 class="sub-header">Model</h1>
    <ol class="breadcrumb">
        <li>Base</li>
        <li class="active">Model</li>
    </ol>

    <div class="alert alert-info" role="alert">
      <strong>Heads up!</strong> ....
    </div>
</section>

<!-- Main content -->
<section class="content">

    <form action="{{ URL::to('laracraft/creative/create') }}" method="POST">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <strong>New Model</strong>
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

    </form>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <strong>Models</strong>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <table class="table">
                            <thead>
                              <tr>
                                <th>Model</th>
                                <th>Created At</th>
                                <th>Size ( Kb )</th>
                                <th>Permission</th>
                                <th>Path</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($models as $model)
                                <tr>
                                    <td class="col-md-3">{{ $model->getFilename() }}</td>
                                    <td class="col-md-2">{{ date('Y-m-d H:i:s', $model->getMTime()) }}</td>
                                    <td class="col-md-2">{{ number_format($model->getSize() / 1024, 2) }}</td>
                                    <td class="col-md-2">{{ substr(sprintf('%o', $model->getPerms()), -4) }}</td>
                                    <td class="col-md-3">{{ $model->getPath() }}</td>
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

</section>
@endsection



@section('js')

<script type="text/javascript">
    $("#model_name").keyup(function() {
        $("#model_name_replace").text( this.value );
    });
</script>


@if(Session::has('success'))
  <script type="text/javascript">
    $.notify({ message: " I am using an image." },{ type: 'success' });
  </script>
@endif

@endsection