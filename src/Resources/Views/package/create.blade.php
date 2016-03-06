@extends('laracraft.layouts.master')

@section('title', 'Package')

@section('content')

    <form action="{{ URL::to('laracraft/package/create') }}" method="POST" id="commands-package-form">
        <div class="row">
            <h3 class="sub-header">Create Simple Package</h3>
            <div class="form-group form-inline">

                <label>Package directory:</label>
                <input type="text" value="" class="form-control" name="package[directory]" id="directory_name" placeholder="Package directory">

                <label>Vendor Name:</label>
                <input type="text" value="" class="form-control" name="package[vendor]" id="vendor_name" placeholder="Vendor Name">

                <label>Package Name:</label>
                <input type="text" value="" class="form-control" name="package[name]" id="vendor_name" placeholder="Package Name">

            </div>
        </div>

        <div class="row top-buffer">
            <button type="submit"id="commands-package-create" class="btn btn-success pull-right">Create!</button>
        </div>
    </form>
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