@extends('adminTemp')
@section('content')
    <div class = 'row advice-row'>
        <div class="advice">
            <h1>批量建议</h1>
            {!! Form::open(['url'=>'advice/inputAll']) !!}
            <div class="form-group">
                {!! Form::label('title','标题:') !!}
                {!! Form::text('title',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('content','建议:') !!}
                {!! Form::textarea('content',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group advice-btu">
                {!! Form::submit('批量建议',['class'=>'btn btn-success form-control']) !!}
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
        <hr class="featurette-divider">
        <div class="single">
            <h1>
                用户列表
            </h1>
            <table class="table table-striped user-table">
                <thead>
                <tr>
                    <th></th>
                    <th>用户名</th>
                    <th>地点</th>
                    <th>操作</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <th></th>
                        <th>{{ $user->name }}</th>
                        <th>{{ $user->location }}</th>
                        <th><p><a class="btn btn-lg btn-primary" href="/advice/user/{{ $user->id }}" role="button">查看详情</a></p></th>
                    </tr>
                @endforeach

                </thead>
            </table>
        </div>
    </div>
@endsection