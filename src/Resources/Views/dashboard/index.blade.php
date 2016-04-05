@extends('laracraft.layouts.master')

@section('title', 'Dashboard')

@section('content')

<section class="content-header">
    <h1 class="sub-header">Dashboard</h1>
    <ol class="breadcrumb">
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <strong>Server Info</strong>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <table class="table">
                            @foreach ($server_info as $arg)
                                <tr>
                                    <td>{{ $arg }}</td>
                                    <td>{{ $_SERVER[$arg] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <strong>Directory Size</strong>
                    </h3>
                </div>
                <div class="panel-body">
                        <div class="col-lg-12">
                            <div id="placeholderradiuslabel" class="graph1"></div>
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
                            <strong>Last 10 Laravel Error Log</strong>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12">
                                <ul class="list-unstyled">
                                    @foreach($last_log as $log)
                                        <li><code>{{ $log }}</code></li>
                                    @endforeach
                                </ul>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section>
@stop

@section('js')
    <script language="javascript" type="text/javascript" src="{{ asset('laracraft/js/charts/jquery.flot.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('laracraft/js/charts/jquery.flot.pie.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('laracraft/js/charts/jquery.flot.resize.js') }}" ></script>
    <script type="text/javascript">
        var data = [{
                        label: "App Size",
                        size: "{{ $app_size }}",
                        data: Math.floor({{ $app_size}} * 100) + 1
                    },
                    {
                        label: "Public Size",
                        size: "{{ $public_size }}",
                        data: Math.floor({{ $public_size}} * 100) + 1
                    },
                    {
                        label: "Storage Size",
                        size: "{{ $storage_size }}",
                        data: Math.floor({{ $storage_size}} * 100) + 1
                    }],
        series = 3;

        $.plot('#placeholderradiuslabel', data, {
            series: {
                pie: { 
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 3/4,
                        formatter: labelFormatter,
                        background: {
                            opacity: 1
                        }
                    }
                }
            },
            legend: {
                show: false
            }, colors: [ '#418BCA', '#F89A14', '#01BC8C', '#EF6F6C', '#67C5DF']
        });

        $("#footer").prepend("Flot " + $.plot.version + " &ndash; ");

        function labelFormatter(label, series, size) {
            return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + series.size + " MB</div>";
        }

        function setCode(lines) {
            $("#code").text(lines.join("\n"));
        }
    </script>
@stop