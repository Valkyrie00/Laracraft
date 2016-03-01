@extends('laracraft.layouts.master')

@section('title', 'Database')

@section('content')
<div class="row">
    <h3 class="sub-header">Migrate</h3>
    <div id="commands-composer-migrate">
        <a href="#" class="btn btn-primary">Migrate Now!</a>
    </div>
    <div id="output">
    </div>
</div>
@endsection


@section('js')
<script type="text/javascript">
    $(document).on('click', '#commands-composer-migrate a', function (e) {
        e.preventDefault();
        $Vconsole =  $( "#valkyrie-console-content");
        var actionUpdate = '/laracraft/database/migration';
        if($Vconsole.attr('vis') =='small'){
            $Vconsole.animate({height:'+=600'})
            $Vconsole.attr('vis','big');
        }

        $.ajax({
            url: actionUpdate,
            type: 'GET'
        });
        return false;
    });
</script>
@endsection