@extends('laracraft.layouts.master')

@section('title', 'Package')

@section('content')
<section class="content-header">
    <h1 class="sub-header">Logs</h1>
    <ol class="breadcrumb">
        <li>Tools</li>
        <li class="active">Logs</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <form action="{{ URL::to('laracraft/logs') }}" method="POST">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <strong>Laravel Log</strong>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12">
                        <button type="submit" class="btn btn-success pull-right">Clear</button>
                            <ul class="list-unstyled">
                            @foreach($logs as $log)
                                <li>{{ $log }}</li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection


@section('js')
@endsection