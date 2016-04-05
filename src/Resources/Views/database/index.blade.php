@extends('laracraft.layouts.master')

@section('title', 'Database')

@section('content')
<section class="content-header">
    <h1 class="sub-header">Database</h1>
    <ol class="breadcrumb">
        <li>Tools</li>
        <li class="active">Database</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <strong>Migrate</strong>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div id="commands-composer-migrate">
                            <a href="#" class="btn btn-primary">Migrate Now!</a>
                        </div>
                        <div id="output">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('js')
<script type="text/javascript">
    $(document).on('click', '#commands-composer-migrate a', function (e) {
        e.preventDefault();
        $Vconsole =  $( "#valkyrie-console-content");
        var actionUpdate = '/laracraft/database/migration';
        $Vconsole.toggleClass('full-height');

        $.ajax({
            url: actionUpdate,
            type: 'GET'
        });
        return false;
    });
</script>
@endsection