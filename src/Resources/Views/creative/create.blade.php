@extends('laracraft.layouts.master')

@section('title', 'Creative')

@section('content')

    <form action="{{ URL::to('laracraft/creative/create') }}" method="POST">

    <div class="row">
        <h3 class="sub-header">Migration</h3>
        <div class="form-group form-inline">

            <label>Table Name:</label>
            <input type="text" value="" class="form-control" name="migration[table_name]" id="table_name" placeholder="Table Name">

            <label> Migration Name:</label>
            <input type="text" value="" class="form-control" name="migration[migration_name]" id="migration_name" placeholder="Migration Name">

            <label> Destination:</label>
            <span>"database/migrations/{{ date('Y_m_d_his') }}_create_<strong><span id="migration_name_replace">MIGRATION-NAME</span></strong>_table.php"</span>

        </div>
        <div class="input_fields_wrap">
           <button class="add_field_button btn btn-primary pull-right">Add Column</button>
        </div>

        <table class="table table-striped" id="column-list">
            <thead>
              <tr>
                <th>Name</th>
                <th>DataType</th>
                <th>Unsigned</th>
                <th>Nullable</th>
                <th>Default</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div class="add_column"></div>
    </div>

    <div class="row top-buffer">
        <h3 class="sub-header">Model</h3>
        <div class="form-group form-inline">
            <label>Model Name:</label>
            <input type="text" value="" class="form-control" name="model[model_name]" id="model_name" placeholder="Model Name">

            <label>Model Table:</label>
            <input type="text" value="" class="form-control" name="model[model_table]" id="model_table" placeholder="Model Table">

            <label> Destination:</label>
            <span>"app/<strong><span id="model_name_replace">MODEL-NAME</span></strong>.php"</span>
        </div>
    </div>

    <div class="row top-buffer">
        <h3 class="sub-header">Controller</h3>
        <div class="form-group form-inline">
            <label>Controller Name:</label>
            <input type="text" value="" class="form-control" name="controller[controller_name]" id="controller_name" placeholder="Controller Name">

            <label> Destination:</label>
            <span>"app/Http/Controllers/<strong><span id="controller_name_replace">CONTROLLER-NAME</span></strong>Controller.php"</span>


        </div>
        <label> Crud:</label>
        <input type="checkbox" name="controller[crud]" value="true">
    </div>


    <div class="row top-buffer">
        <button type="submit" class="btn btn-success pull-right">Create!</button>
    </div>
    </form>
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
                    newRowsContent += '<td><input type="text" value="" class="form-control" name="migration[component]['+ currentx +'][column_name]"></td>';
                    newRowsContent += '<td><select name="migration[component]['+ currentx +'][column_type]"><option value="bigIncrements">bigIncrements</option><option value="bigInteger">bigInteger</option><option value="binary">binary</option><option value="boolean">boolean</option><option value="char">char</option><option value="date">date</option><option value="dateTime">dateTime</option><option value="decimal">decimal</option><option value="double">double</option><option value="enum">enum</option><option value="float">float</option><option value="increments">increments</option><option value="integer">integer</option><option value="longText">longText</option><option value="mediumInteger">mediumInteger</option><option value="mediumText">mediumText</option><option value="morphs">morphs</option><option value="nullableTimestamps">nullableTimestamps</option><option value="smallInteger">smallInteger</option><option value="tinyInteger">tinyInteger</option><option value="softDeletes">softDeletes</option><option value="string">string</option><option value="text">text</option><option value="time">time</option><option value="timestamp">timestamp</option><option value="timestamps">timestamps</option><option value="rememberToken">rememberToken</option></select></td>';
                    newRowsContent += '<td><input type="checkbox" name="migration[component]['+ currentx +'][unsigned]" value="true"></td>';
                    newRowsContent += '<td><input type="checkbox" name="migration[component]['+ currentx +'][nullable]" value="true"></td>';
                    newRowsContent += '<td><input type="text" value="" class="form-control" name="migration[component]['+ currentx +'][default]"></td>';
                    newRowsContent += '<td><a href="#" class="remove_field btn btn-danger">Remove</a></td>';
                newRowsContent += '</tr>';
                $("#column-list tbody").append(newRowsContent); 
            }
        });

        $('#column-list tbody').on("click",".remove_field", function(e){
            e.preventDefault(); $(this).parents('tr').remove(); x--;
        })
    });

    $("#table_name").keyup(function() {
        $("#model_table").val( this.value );
        $('#model_table').attr('readonly', false);
        if(this.value != ''){
            $('#model_table').attr('readonly', true);
        }
    });

    $("#migration_name").keyup(function() {
        $("#migration_name_replace").text( this.value );
    });

    $("#model_name").keyup(function() {
        $("#model_name_replace").text( this.value );
    });

    $("#controller_name").keyup(function() {
        $("#controller_name_replace").text( this.value );
    });
</script>

@endsection