@extends('app')
@section('content')
    <div class = 'row'>
        <div class="col-sm-12 col-md-9 aw-main-content">
            <h1>发起新活动</h1>
            {!! Form::open(['url'=>'game/update']) !!}
            {!! Form::hidden('id',$game->id) !!}
            <div class="form-group">
                {!! Form::label('name','标题:') !!}
                {!! Form::text('name',$game->name,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('location','活动地点:') !!}
                {!! Form::text('location',$game->location,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('time','活动时间:') !!}
                {!! Form::input('date','time',date($game->time),['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('kind','活动类型:') !!}
                {!!  Form::select('kind',[
                    '活动1'=> ['swim' => '游泳'],
                    '活动2'=>['run' => '跑步'],
                    '活动3'=>['bike' => '骑车'],
                    '活动4'=>['homesports' => '健身'],
                ])!!}
            </div>
            <div class="form-group">
                {!! Form::label('content','正文:') !!}
                {!! Form::textarea('content',$game->content,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('发起活动',['class'=>'btn btn-success form-control']) !!}
            </div>
            {!! Form::close() !!}
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <script type="text/javascript">
                $(function() {
                    $(".js-example-basic-multiple").select2({
                        placeholder: "添加标签"
                    });
                });
            </script>
        </div>
        <div class="col-sm-12 col-md-3 aw-side-bar hidden-xs">
            <!-- 问题发起指南 -->
            <div class="aw-mod publish-help">
                @if($game->susers)
                    <div class="col-lg-3 col-lg-push-1">
                        <h3>
                            加入活动的人
                        </h3>
                        <table class="table table-striped user-table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>用户名</th>
                                <th>地点</th>
                                <th>签名</th>
                            </tr>
                            @foreach($game->susers as $user)
                                <tr>
                                    <th></th>
                                    <th>{{ $user->name }}</th>
                                    <th>{{ $user->location }}</th>
                                    <th>{{ $user->sign }}</th>
                                </tr>
                            @endforeach

                            </thead>
                        </table>


                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection