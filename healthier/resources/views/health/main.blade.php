@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-3 sidebar">
                <ul class="nav nav-sidebar" id="myTab" role="tablist">
                    <li role="presentation" class="active"><a href="#all" id="page_all" data-toggle="tab">概览</a></li>
                    <li role="presentation"><a href="#sports" id="page_sport" data-toggle="tab">运动</a></li>
                    <li role="presentation"><a href="#sleep" id="page_sleep" data-toggle="tab">睡眠</a></li>
                    <li role="presentation"><a href="#hr" id="page_hr" data-toggle="tab">心率</a></li>
                    <li role="presentation"><a href="#bp" id="page_bp" data-toggle="tab">血压</a></li>
                </ul>
            </div>
            <div class="col-lg-8 main">
                <div class="tab-content">
                    <div  role="tabpanel" class="tab-pane active" id="all">
                        <div class="jumbotron">
                            <h1>个人健康概览</h1>
                            <div class="row">

                            </div>
                        </div>

                        <div class="table-responsive">
                            <h1>健康数据</h1>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>日期</th>
                                    <th>心率</th>
                                    <th>收缩压</th>
                                    <th>舒张压</th>
                                    <th>运动时间</th>
                                    <th>睡眠时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tab as $x)
                                    <tr>
                                        <td>{{$x[0]}}</td>
                                        <td>{{$x[1]}}</td>
                                        <td>{{$x[2]}}</td>
                                        <td>{{$x[3]}}</td>
                                        <td>{{$x[4]}}</td>
                                        <td>{{$x[5]}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>



                    <div  role="tabpanel" class="tab-pane active" id="sports">
                        <div class="jumbotron">
                            <h1>运动分布情况</h1>
                            <div class="row">
                                <div class="col-lg-10">
                                    <canvas id="data1" data-type="Line" data-id="data1" width="600px" height="400px"></canvas>
                                    <pre data-type="javascript"><code data-for="data1" hidden>var data = {
                                            labels : {{ $time1 }},
                                            datasets : [
                                            {
                                            fillColor : "rgba(220,220,220,0.5)",
                                            strokeColor : "rgba(220,220,220,1)",
                                            data : {{$sp1}}
                                            },

                                            ]
                                            }</code></pre>
                                </div>



                            </div>
                        </div>

                    </div>
                    <div  role="tabpanel" class="tab-pane active" id="sleep">
                        <div class="jumbotron">
                            <h1>睡眠分布情况</h1>
                            <div class="row">
                                <div class="col-lg-10">
                                    <canvas id="data2" data-type="Line" width="600px" height="400px"></canvas>
                                    <pre data-type="javascript"><code data-for="data2" hidden>var data = {
                                            labels : {{ $time1 }},
                                            datasets : [
                                            {
                                            fillColor : "rgba(151,187,205,0.5)",
                                            strokeColor : "rgba(151,187,205,1)",
                                            pointColor : "rgba(151,187,205,1)",
                                            data : {{$sl1}}
                                            }

                                            ]
                                            }</code></pre>
                                </div>


                            </div>
                        </div>

                    </div>
                    <div  role="tabpanel" class="tab-pane active" id="hr">
                        <div class="jumbotron">
                            <h1>心率分布情况</h1>
                            <div class="row">
                                <div class="col-lg-10">
                                    <canvas id="data3" data-type="Line" width="600px" height="400px"></canvas>
                                    <pre data-type="javascript"><code data-for="data3" hidden>var data = {
                                            labels : {{ $time1 }},
                                            datasets : [
                                            {
                                            fillColor : "rgba(220,220,220,0.5)",
                                            strokeColor : "rgba(220,220,220,1)",
                                            data : {{$hr2}}
                                            }

                                            ]
                                            }</code></pre>
                                </div>


                            </div>
                        </div>

                    </div>
                    <div  role="tabpanel" class="tab-pane active" id="bp">
                        <div class="jumbotron">
                            <h1>血压分布情况</h1>
                            <div class="row">
                                <div class="col-lg-10">
                                    <canvas id="data4" data-type="Line" width="600px" height="400px"></canvas>
                                    <pre data-type="javascript"><code data-for="data4" hidden>var data = {
                                            labels : {{ $time1 }},
                                            datasets : [
                                            {
                                            fillColor : "rgba(220,220,220,0.5)",
                                            strokeColor : "rgba(220,220,220,1)",
                                            data : {{$hbp1}}
                                            },
                                            {
                                            fillColor : "rgba(151,187,205,0.5)",
                                            strokeColor : "rgba(151,187,205,1)",
                                            data : {{$lbp1}}
                                            }

                                            ]
                                            }</code></pre>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('js')
    <script>

        $(document).ready(function(){
            $("canvas").each(function(){
                var $canvas = $(this);
                var ctx = this.getContext("2d");

                eval($("code[data-for='" + $canvas.attr("id") + "']").text());
                /*var data1 = {
                    labels : ["January","February","March","April","May","June","July"],
                    datasets : [
                        {
                            fillColor : "rgba(220,220,220,0.5)",
                            strokeColor : "rgba(220,220,220,1)",
                            pointColor : "rgba(220,220,220,1)",
                            pointStrokeColor : "#fff",
                            data : [65,59,90,81,56,55,40]
                        },
                        {
                            fillColor : "rgba(151,187,205,0.5)",
                            strokeColor : "rgba(151,187,205,1)",
                            pointColor : "rgba(151,187,205,1)",
                            pointStrokeColor : "#fff",
                            data : [28,48,40,19,96,27,100]
                        }
                    ]
                }*/


                var evalString = "new Chart(ctx)." + $canvas.data("type") + "(data);";

                eval(evalString);
            });
        });

    </script>
@endsection