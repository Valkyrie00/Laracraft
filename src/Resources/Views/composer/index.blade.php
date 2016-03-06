@extends('laracraft.layouts.master')

@section('title', 'Composer')

@section('content')
<div class="row">
    <h3 class="sub-header">Composer update</h3>
    <div id="commands-composer-update">
        <a href="#" class="btn btn-primary">Update Now!</a>
    </div>
    <div id="output">
    </div>
</div>

<div class="row">
    <h3 class="sub-header">Install Package</h3>
    <form class="form-inline" id="search-form">
      <div class="form-group">
        <label>Search: </label>
        <input type="text" class="form-control" id="packages_search" placeholder="Package Name">
      </div>
    </form>
</div>

<div class="row">
    <table class="table table-striped" id="package-list">
        <thead>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Download</th>
            <th>Stars</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection


@section('js')
<script type="text/javascript">
    $(document).on('click', '#commands-composer-update a', function (e) {
        e.preventDefault();
        $Vconsole =  $( "#valkyrie-console-content");
        var actionUpdate = '/laracraft/composer/update';
        $Vconsole.toggleClass('full-height');

        $.ajax({
            url: actionUpdate,
            type: 'GET'
        });
        return false;
    });

    $(document).on('click', '#commands-composer-install', function (e) {
        e.preventDefault();
        $Vconsole =  $( "#valkyrie-console-content");
        var actionInstall = '/laracraft/composer/install';
        var repository = $(this).data("repository");
        $Vconsole.toggleClass('full-height');

        $.ajax({
            url: actionInstall,
            type: 'GET',
            data: { repository_name: repository }
        });
    });
</script>

<script type="text/javascript">

    var list = $('.search-list'),
        form = $('form#search-form'),
        doSearch,
        showData;

    showData = function (data) {
        var newRowsContent;

        $("#package-list tbody").empty();

        newRowsContent = '';
        $.each(data['results'], function( index, value ) {
            newRowsContent += "<tr>";
                newRowsContent += "<td><strong>"+value['name']+"</strong></td>";
                newRowsContent += "<td>"+value['description']+"</td>";
                newRowsContent += "<td>"+value['downloads']+"</td>";
                newRowsContent += "<td>"+value['favers']+"</td>";
                newRowsContent += "<td><a class='btn btn-primary' href="+value['url']+" target='_blank'>Details</a> ";
                newRowsContent += "<a id='commands-composer-install' class='btn btn-success' href='#' data-repository='"+value['name']+"'>Install</a></td>";
            newRowsContent += "</tr>";
        });

        $("#package-list tbody").append(newRowsContent); 
    };

    doSearch = function () {
        var query = $('#packages_search'),
            q;

        if (query.val().match(/^\s*$/) === null) {

            q = query.val();

            $.ajax({
                type: "GET",
                url: "https://packagist.org/search.json?q="+q+"&callback=showData",
                jsonp: 'showData',
                dataType: "jsonp",
            })
        }
    };


    form.bind('keyup search', doSearch);


</script>



@endsection