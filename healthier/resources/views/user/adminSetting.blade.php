@extends('adminTemp')
@section('content')
    <div class="newAdmin">
        <h1>修改管理员账户</h1>
        {!! Form::open(['url'=>'admin/updateInfo']) !!}
        {!! Form::hidden('id',$admin->id) !!}
        <div class="form-group">
            {!! Form::label('name','名字:') !!}
            {!! Form::text('name',$admin->name,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email','邮箱:') !!}
            {!! Form::email('email',$admin->email,['class'=>'form-control']) !!}
        </div>
        <div class="form-group advice-btu">
            {!! Form::submit('修改用户',['class'=>'btn btn-success form-control']) !!}
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
    <hr class="featurette-divider">
    <div class="newPass">
        <h1>修改密码</h1>
        {!! Form::open(['url'=>'admin/updatePass']) !!}
        {!! Form::hidden('id',$admin->id) !!}
        <div class="form-group">
            {!! Form::label('oldpassword','原密码:') !!}
            {!! Form::input('password','oldpassword',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password','新密码:') !!}
            {!! Form::input('password','password',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password_confirmation','重复密码:') !!}
            {!! Form::input('password','password_confirmation',null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group advice-btu">
            {!! Form::submit('修改密码',['class'=>'btn btn-success form-control']) !!}
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

    <div class="test">
        <p><a class="btn btn-warning btn-lg" href="/turn" role="button">操作界面</a></p>
    </div>
@endsection