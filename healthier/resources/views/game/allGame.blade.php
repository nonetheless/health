@extends('app')
@section('content')
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img class="first-slide" src="/image/bike.jpg" alt="First slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>健康的生活方式</h1>
                        <p>“想着要赢得比赛不会给你力量，在锻炼中挣扎力量才会增长，当你克服困难不想放弃时，这就是力量。”——阿诺德·施瓦辛格</p>
                        <p><a class="btn btn-lg btn-primary" href="/game/new" role="button">加入运动</a></p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img class="second-slide" src="/image/run.jpg" alt="Second slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>专业的健康专家</h1>
                        <p>不会管理自己身体的人，就无资格管理他人；经营不好自己健康的人，又如何经营好他的事业。——希尔康</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">专家建议</a></p>
                    </div>
                </div>
            </div>

        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div><!-- /.carousel -->



    <div class="container marketing">


        <!-- START THE FEATURETTES -->
        @foreach($games as $game)

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h1>{{$game->name}}</h1>
                <ul class="post-meta pad group">
                    <li><i class="fa fa-clock-o"></i>{{ $game->time }}</li>
                    <li><i class="fa fa-tag"></i>{{ $game->location }}</li>
                    <li><i class="fa fa-tag"></i>{{ $game->kind }}</li>
                </ul>
                <p class="game-info text-info">{{$game->info}}</p>
                <p class="game-btu"><a class="btn btn-lg btn-primary" href="/game/{{ $game->id }}" role="button">加入运动</a></p>
            </div>
            <div class="col-md-5">
                <img src="/image/{{ $game->kind }}.jpg" class="featurette-image img-responsive center-block" alt="Generic placeholder image" script="height : 30; width: 40px">
            </div>
        </div>
        @endforeach

    </div>

@endsection