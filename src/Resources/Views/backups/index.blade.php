@extends('laracraft.layouts.master')

@section('title', 'Create Backup')

@section('content')
<section class="content-header">
    <h1 class="sub-header">Backups</h1>
    <ol class="breadcrumb">
        <li>Tools</li>
        <li class="active">Backups</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <form action="{{ route('laracraft.backups.store') }}" method="POST">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <strong>New Backup</strong>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th>Backup name</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-md-6"><input type="text" class="form-control" name="backup_name" id="backup_name" placeholder="Backup name"></td>
                                        <td class="col-md-6"><button type="submit" class="btn btn-primary">Create</button></td>
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
                            <strong>Backups</strong>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Download</th>
                                    <th>Created At</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($backups as $backup)
                                        <tr>
                                            <td>{{ $backup->id }}</td>
                                            <td>{{ $backup->name }}</td>
                                            <td><a href="{{ URL::to('laracraft/backups/download',[$backup->id]) }}"> Download </a></td>
                                            <td>{{ $backup->created_at }}</td>
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
@endsection