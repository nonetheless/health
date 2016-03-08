@extends('app')

@section('content')
    <?php if(!isset($_SESSION)){ session_start();}; ?>
    <div class="user">
        <h1>个人资料</h1>
        <hr class="featurette-heading">
        <div class="account">
            <div class="row">
                <div class="col-md-2" style="text-align: center; margin-bottom:20px;">
                    <div class="account-picture-block text-center">
                        <img id="user-current-picture" class="user-profile-picture img-thumbnail" src="/image/user{{$_SESSION['id']}}.jpg" /><br /><br />
                        <button type="button" data-toggle="modal" data-target="#myModal" id="changePictureBtn" class="btn btn-primary">更改头像</button>
                        <br/><br/>

                    </div>
                </div>

                <div class="col-md-5">
                    <div>
                        <form class='form-horizontal' method="POST" action="/user/updateInfo">

                            <div class="control-group">
                                <label class="control-label" for="inputUsername">用户名</label>
                                <div class="controls">
                                    <input name='name' class="form-control" type="text" id="inputUsername" placeholder="用户名" value={!! $user->name !!}>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="inputEmail">电子邮件</label>
                                <div class="controls">
                                    <input name = 'email' class="form-control" type="text" id="inputEmail" placeholder="电子邮件" value={!! $user->email !!}>
                                </div>

                            </div>

                            <div class="control-group">
                                <label class="control-label" for="inputLocation">所在地</label>
                                <div class="controls">
                                    <input name = 'location' class="form-control" type="text" id="inputLocation" placeholder="" value={!! $user->location !!}>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="inputBirthday">生日</label>
                                <div class="controls">
                                    <input name = 'birthday' type='date' class="form-control" id="inputBirthday" value={!! $user->birthday !!} placeholder="yyyy-mm-dd">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="inputAboutMe">关于我</label> <small><label id="aboutMeCharCountLeft"></label></small>
                                <div class="controls">
                                    <textarea name = 'about' class="form-control" id="inputAboutMe" rows="5">{!! $user->about !!}</textarea>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="inputSignature">签名档</label> <small><label id="signatureCharCountLeft"></label></small>
                                <div class="controls">
                                    <textarea name = 'sign' class="form-control" id="inputSignature" rows="5">{!! $user->sign !!}</textarea>
                                </div>
                            </div>

                            <input type="hidden" id="inputUID" value="93"><br />

                            <div class="form-actions">
                                <button class="btn btn-primary" type="submit">保存更改</button>
                            </div>
                            <input type="hidden" name="_token" value={{csrf_token()}} >
                        </form>
                    </div>

                    <hr class="visible-xs visible-sm"/>
                </div>

                <div class="col-md-5">
                    <div style="vertical-align:top;">
                        <form class='form-horizontal' method="POST" action="/user/updatePassword">
                            <div class="control-group">
                                <label class="control-label" for="inputCurrentPassword">当前密码</label>
                                <div class="controls">
                                    <input name ='oldPassword' autocomplete="off" class="form-control" type="password" id="inputCurrentPassword" placeholder="当前密码" value="">
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label" for="inputNewPassword">密码</label>
                                <div class="input-group">
                                    <input name ='newPassword' class="form-control" type="password" id="inputNewPassword" placeholder="密码" value="">
                                <span class="input-group-addon">
                                    <span id="password-notify"><i class="fa fa-circle-o"></i></span>
                                </span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="inputNewPasswordAgain">确认密码</label>
                                <div class="input-group">
                                    <input name ='surePassword' class="form-control" type="password" id="inputNewPasswordAgain" placeholder="确认密码" value="">
                                <span class="input-group-addon">
                                    <span id="password-confirm-notify"><i class="fa fa-circle-o"></i></span>
                                </span>
                                </div>
                            </div>
                            <br/>
                            <div class="form-actions">
                                <button class="btn btn-primary" type="submit" onclick="return check()">更改密码</button>
                            </div>
                            <input type="hidden" name="_token" value={{csrf_token()}} >
                        </form>
                        <script>
                            function  check(){
                                var pwd1 = document.getElementById("inputNewPassword").value;
                                var pwd2 = document.getElementById("inputNewPasswordAgain").value;
                                if(pwd2!=pwd1){
                                    alert("两次输入的密码不一致,请检查！");
                                    return false;
                                }
                                return true;
                            }
                        </script>
                    </div>
                </div>
            </div>

        </div>

        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="更改头像" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">更改头像</h3>
                    </div>
                    <div class="modal-body">
                        <div id="gravatar-box">
                            <img id="user-gravatar-picture" src="/image/user{{$_SESSION['id']}}.jpg" class="img-thumbnail user-profile-picture">
                        </div>
                        <br/>
                        {!! Form::open([ 'url' => ['/user/updateImg'], 'method' => 'POST', 'id' => 'upload', 'files' => true ] )  !!}
                        <div class="form-group">
                            {!! Form::label('file','头像:') !!}
                            {!! Form::input('file','image',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('上传',['class'=>'btn btn-primary form-control']) !!}
                        </div>

                        {!! Form::close()!!}






                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </div>
@endsection