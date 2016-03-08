@extends('app')
@section('content')
    <div class = 'row'>
        <div class="col-sm-12 col-md-9 aw-main-content">
            <h1>发起新活动</h1>
            {!! Form::open(['url'=>'game/store']) !!}
            <div class="form-group">
                {!! Form::label('name','标题:') !!}
                {!! Form::text('name',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('location','活动地点:') !!}
                {!! Form::text('location',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('time','活动时间:') !!}
                {!! Form::input('date','time',date('Y-m-d'),['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('kind','活动类型:') !!}
                {!!  Form::select('kind', [
                    '活动1'=> ['swim' => '游泳'],
                    '活动2'=>['run' => '跑步'],
                    '活动3'=>['bike' => '骑车'],
                    '活动4'=>['homesports' => '健身'],
                ])!!}
            </div>
            <div class="form-group">
                {!! Form::label('content','正文:') !!}
                {!! Form::textarea('content',null,['class'=>'form-control']) !!}
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
                <div class="mod-head">
                    <h3>活动发起指南</h3>
                </div>
                <div class="mod-body">
                    <p><b>• 活动标题:</b> 请用准确的语言描述您发布的活动</p>
                    <p><b>• 活动简介:</b> 详细补充您的活动内容, 并提供一些相关的素材以供参与者更多的了解您的主题思想</p>
                    <p><b>• 时间:</b> 选择活动的时间</p>
                </div>
            </div>

        </div>
    </div>
@endsection