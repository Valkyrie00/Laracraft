@extends('laracraft.layouts.master')

@section('title', 'Package')

@section('content')
<section class="content-header">
    <h1 class="sub-header">Environment</h1>
    <ol class="breadcrumb">
        <li>Configurations</li>
        <li class="active">Environment</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <form action="{{ URL::to('laracraft/config/env') }}" method="POST">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <strong>Environment</strong>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <table class="table" id="env-list">
                                @foreach ($data as $k=>$v)
                                    <tr>
                                        <td>{{ $k }}</td>
                                        <td><input type="text" value="{{ $v }}" class="form-control" name="edit[{{$k}}]" placeholder="Value"></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="input_fields_wrap">
           <button class="add_field_button btn btn-primary pull-left">Add Value</button>
        </div>

        <div class="row">
            <button type="submit" class="btn btn-success pull-right">Update</button>
        </div>
    </form>
</section>
@endsection


@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".add_column"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID


        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                var currentx = x++; //text box increment

            var newRowsContent = '<tr>';
                    newRowsContent += '<td><input type="text" value="" class="form-control" name="new['+ currentx +'][name]"></td>';
                    newRowsContent += '<td><input type="text" value="" class="form-control" name="new['+ currentx +'][value]"></td>';
                newRowsContent += '</tr>';
                $("#env-list tbody").append(newRowsContent); 
            }
        });

        $('#column-list tbody').on("click",".remove_field", function(e){
            e.preventDefault(); $(this).parents('tr').remove(); x--;
        })
    });
</script>

@endsection