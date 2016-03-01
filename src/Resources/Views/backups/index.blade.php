@extends('laracraft.layouts.master')

@section('title', 'Create Backup')

@section('content')

<div class="row">
    <h3 class="sub-header">New Backup</h3>
    <div class="col-md-4">
        <form action="{{ route('laracraft.backups.store') }}" method="POST">

              <div class="form-group">
                <label for="backup_name">Backup name</label>
                <input type="text" class="form-control" name="backup_name" id="backup_name" placeholder="Backup name">
              </div>

              <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
<div class="row">
    <h3 class="sub-header">Backups</h3>
    <table class="table table-striped">
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
@endsection


@section('js')
@endsection