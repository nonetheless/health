@extends('app')
@section('content')
    <div class = "row">
        <div class="jumbotron title">
            <h1>运动活动</h1>
            <p>还在一个人运动吗？快来加入我们吧，我们有很多活动哦，大家一起来运动</p>
            <p>没有想要的活动吗？自己发起一个吧</p>
            <a class="btn btn-lg btn-primary" herf="/game/new">
                发起活动
            </a>
        </div>

        <div class="container">

            <div class="col-lg-8 article">
                <h1>{{ $game->name }}</h1>
                <h4>发起人：<a herf="/user/{{ $user->id }}">{{ $user->name }}</a></h4>
                <hr class="feather-driver">
                <ul class="post-meta pad group">
                    <li><i class="fa fa-clock-o"></i>{{ $game->time }}</li>

                    <li><i class="fa fa-tag"></i>{{ $game->kind }}</li>

                    <li><i class="fa fa-tag">{{ $game->location }}</i></li>


                </ul>

                <hr class="feather-driver">

                <p>{{ $game->content }}</p>

                @if($test==0)

                    <p><a class="btn btn-lg btn-primary" href="/game/join/{{ $game->id }}" role="button">加入活动</a></p>
                @elseif($test==2)
                    <p><a class="btn btn-warning btn-lg" href="/game/out/{{ $game->id }}" role="button">退出加入</a></p>
                @else
                    <p><a class="btn btn-lg btn-primary" href="/game/change/{{ $game->id }}" role="button">修改活动</a></p>
                    <p><a class="btn btn-lg btn-primary" href="/game/del/{{ $game->id }}" role="button">删除活动</a></p>
                @endif
            </div>
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
                                        <th><a href="/user/home/{{ $user->id }}">{{ $user->name }}</a></th>
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

@endsection