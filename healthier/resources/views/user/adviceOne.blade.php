@extends('adminTemp')
@section('content')
    <div class = 'row advice-row'>
        <div class="advice">
            <h1>建议</h1>
            {!! Form::open(['url'=>'advice/inputOne']) !!}
            {!! Form::hidden('userId',$id) !!}
            <div class="form-group">
                {!! Form::label('title','标题:') !!}
                {!! Form::text('title',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('content','建议:') !!}
                {!! Form::textarea('content',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group advice-btu">
                {!! Form::submit('建议',['class'=>'btn btn-success form-control']) !!}
            </div>
            {!! Form::close() !!}
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="info">
            <div class="mod-footer">
                <ul class="nav nav-tabs aw-nav-tabs">
                    <li><a href="#advice" id="page_answers" data-toggle="tab">表格数据</a></li>
                    <li  class="active"><a href="#health" id="page_answers" data-toggle="tab">一周健康图</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane " id="advice">
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
                <div class="tab-pane active" id="health">
                    <h2>一周健康状况</h2>
                    <hr class="feather-driver">
                    <h3>
                        运动状况
                    </h3>
                    <canvas id="data1" data-type="Line" data-id="data1" width="600px" height="300px"></canvas>
                    <pre data-type="javascript"><code data-for="data1" hidden>var data = {
                            labels : {{ $time1 }},
                            datasets : [
                            {
                            fillColor : "rgba(220,220,220,0.5)",
                            strokeColor : "rgba(220,220,220,1)",
                            data : {{$sp1}}
                            },

                            ]
                            }
                        </code>
                    </pre>
                    <hr>
                    <h3>睡眠</h3>
                    <canvas id="data2" data-type="Line" width="600px" height="300px"></canvas>
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
                            }
                        </code>
                    </pre>
                    <hr>
                    <h3>心率</h3>
                    <canvas id="data3" data-type="Line" width="600px" height="300px"></canvas>
                    <pre data-type="javascript"><code data-for="data3" hidden>var data = {
                            labels : {{ $time1 }},
                            datasets : [
                            {
                            fillColor : "rgba(220,220,220,0.5)",
                            strokeColor : "rgba(220,220,220,1)",
                            data : {{$hr2}}
                            }

                            ]
                            }</code>
                    </pre>
                    <hr>
                    <h3>血压</h3>
                    <canvas id="data4" data-type="Line" width="600px" height="300px"></canvas>
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
                            }
                        </code>
                    </pre>
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
                var data1 = {
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
                }



                var evalString = "new Chart(ctx)." + $canvas.data("type") + "(data);";

                eval(evalString);
            });
        });

    </script>
@endsection