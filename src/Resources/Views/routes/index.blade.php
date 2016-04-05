@extends('laracraft.layouts.master')

@section('title', 'Package')

@section('content')
<section class="content-header">
    <h1 class="sub-header">Routes</h1>
    <ol class="breadcrumb">
        <li>Tools</li>
        <li class="active">Routes</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <strong>Routes</strong>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection


@section('js')

<script type="text/javascript">
    $(document).on('click', '#commands-package-create', function (e) {
        e.preventDefault();
        $Vconsole =  $( "#valkyrie-console-content");
        var actionUpdate = '/laracraft/composer/update';
        $Vconsole.toggleClass('full-height');

        form = $("#commands-package-form").serialize();
        console.log(form);

        $.ajax({
          type: "POST",
          url: '/laracraft/package/create',
          data: form
        });

        return false;
    });
</script>

@endsection