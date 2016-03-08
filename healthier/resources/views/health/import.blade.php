@extends('app')
@section('content')
    <div class="newFile">
        <h1>上传健康数据</h1>
        {!! Form::open([ 'url' => ['/health/store'], 'method' => 'POST', 'id' => 'upload', 'files' => true ] )  !!}
        <div class="form-group">
            {!! Form::label('file','文件:') !!}
            {!! Form::input('file','file',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group advice-btu">
            {!! Form::submit('上传',['class'=>'btn btn-success form-control']) !!}
        </div>

        {!! Form::close()!!}

    </div>

@endsection