@extends('adminTemp')
@section('content')
    <div class="newAdmin">
        <h1>添加管理用户</h1>
        {!! Form::open(['url'=>'admin/store']) !!}
        <div class="form-group">
            {!! Form::label('email','邮箱:') !!}
            {!! Form::email('email',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password','密码') !!}
            {!! Form::input('password','password',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('kind','用户类型:') !!}
            {!!  Form::select('kind', [
                '1'=> ['admin' => '管理员'],
                '2'=>['doctor' => '医生'],
                '3'=>['teacher' => '教练'],
            ])!!}
        </div>

        <div class="form-group advice-btu">
            {!! Form::submit('新增用户',['class'=>'btn btn-success form-control']) !!}
        </div>
        {!! Form::close()!!}
        @if($errors->any())
            <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <hr class = 'featurette-divider'>
    <h1>管理用户</h1>
    <table class="table table-striped user-table">
        <thead>
        <tr>
            <th></th>
            <th>用户名</th>
            <th>类型</th>
            <th>删除</th>
        </tr>
        @foreach($admin as $user)
            <tr>
                <th></th>
                <th>{{ $user->name }}</th>
                <th>{{ $user->kind}}</th>
                <th><p><a class="btn btn-lg btn-primary" href="/admin/del/{{ $user->id }}" role="button">删除用户</a></p></th>
            </tr>
        @endforeach

        </thead>
    </table>
@endsection