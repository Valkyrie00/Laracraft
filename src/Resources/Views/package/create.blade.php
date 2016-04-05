@extends('laracraft.layouts.master')

@section('title', 'Package')

@section('content')
<section class="content-header">
    <h1 class="sub-header">Package</h1>
    <ol class="breadcrumb">
        <li>Tools</li>
        <li class="active">Package</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <form action="{{ URL::to('laracraft/package/create') }}" method="POST" id="commands-package-form">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <strong>Create Simple Package</strong>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th>Package directory</th>
                                    <th>Vendor Name</th>
                                    <th>Package Name</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-md-3"><input type="text" value="" class="form-control" name="package[directory]" id="directory_name" placeholder="Package directory"></td>
                                        <td class="col-md-3"><input type="text" value="" class="form-control" name="package[vendor]" id="vendor_name" placeholder="Vendor Name"></td>
                                        <td class="col-md-6"><input type="text" value="" class="form-control" name="package[name]" id="vendor_name" placeholder="Package Name"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row top-buffer">
            <button type="submit"id="commands-package-create" class="btn btn-success pull-right">Create!</button>
        </div>
    </form>
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