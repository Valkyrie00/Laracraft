@extends('laracraft.layouts.master')

@section('title', 'Composer')

@section('content')
<section class="content-header">
    <h1 class="sub-header">Composer</h1>
    <ol class="breadcrumb">
        <li>Tools</li>
        <li class="active">Composer</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <strong>Composer Actions</strong>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div id="commands-composer-update">
                            <a href="#" class="btn btn-primary">Update Now!</a>
                        </div>
                        <div id="output">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <strong>Install Packages</strong>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <form class="form-inline" id="search-form">
                          <div class="form-group">
                            <label>Search: </label>
                            <input type="text" class="form-control" id="packages_search" placeholder="Package Name">
                          </div>
                        </form>

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
                </div>
            </div>
        </div>
    </div>

</section>
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
                newRowsContent += "<td class='col-md-3'><strong>"+value['name']+"</strong></td>";
                newRowsContent += "<td class='col-md-5'>"+value['description']+"</td>";
                newRowsContent += "<td class='col-md-1'>"+value['downloads']+"</td>";
                newRowsContent += "<td class='col-md-1'>"+value['favers']+"</td>";
                newRowsContent += "<td class='col-md-3'><a class='btn btn-primary' href="+value['url']+" target='_blank'>Details</a> ";
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