@extends('app')
@section('content')
    <div class="row">
        <div class="col-md-8 aw">
            <!-- 用户数据内容 -->
            <div class="aw-mod">
                <div class="mod-head">
                    <div class="row">
                        <h1>{{$user->name}} </h1>
                        <img src="/image/user{{$user->id}}.jpg" alt="Nonetheless" style="height: 250px;width: 200px" />
                    </div>




                </div>
                <div class="mod-footer">
                    <ul class="nav nav-tabs aw-nav-tabs">
                        <li><a href="#overview" id="page_overview" data-toggle="tab">概述</a></li>
                        <li><a href="#sports" id="page_questions" data-toggle="tab">活动<span class="badge">{{ $games->count() }}</span></a></li>
                        <li><a href="#advice" id="page_answers" data-toggle="tab">建议<span class="badge">{{ $advices->count() }}</span></a></li>
                        <li  class="active"><a href="#health" id="page_answers" data-toggle="tab">健康</a></li>
                    </ul>
                </div>
            </div>
            <!-- end 用户数据内容 -->


            <div class="tab-content">
                <div class="tab-pane " id="overview">
                    <h2>生日</h2>
                    <p>{{ $user->birthday }}</p>
                    <h2>地点</h2>
                    <p>{{ $user->location }}</p>
                    <h2>个人签名</h2>
                    <p>{{ $user->sign }}</p>
                    @if($test==1)
                        <hr>
                        <p><a class="btn btn-lg btn-primary" href="/setting/{{ $user->id }}" role="button">修改资料</a></p>
                    @endif
                </div>
                <div class="tab-pane" id="sports">
                    <h2>活动</h2>
                    <hr class="feather-driver">
                    @foreach($games as $game)
                        <article class="post">
                            <div class="post-head">
                                <h1 class="post-title">{{$game->name}}</h1>
                                <div class="post-meta">
                                    <a class="alert-link" href="/user/home/{{ $game->writerId }}">发起人</a>
                                    <em><p>时间：{{ $game->time }}      </p></em>
                                    <em><p>地点：{{ $game->location }}      </p></em>
                                    <em><p>类型：{{ $game->kind }}      </p></em>
                                </div>
                            </div>
                            <div class="post-content">
                                <p class=".lead">
                                    {{$game->info}}
                                </p>
                            </div>
                            <div class="post-permalink">
                                <p class="game"><a class="btn btn-lg btn-primary" href="/game/{{ $game->id }}" role="button">查看详情</a></p>
                            </div>

                        </article>

                        <hr class="featurette-divider">
                    @endforeach

            </div>
                <div class="tab-pane" id="advice">
                    <h2>建议</h2>
                    <hr class="feather-driver">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        @foreach($advices as $advice)
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading{{$advice->id}}">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$advice->id}}" aria-expanded="true" aria-controls="collapse{{$advice->id}}">
                                            {{$advice->title}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse{{$advice->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$advice->id}}">
                                    <div class="panel-body">
                                        {{$advice->content}}
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
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
                    <hr>
                    @if($test==1)
                        <p><a class="btn btn-lg btn-primary" href="/health/user" role="button">详情</a></p>
                    @endif

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