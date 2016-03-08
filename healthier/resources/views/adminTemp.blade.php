<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="nonetheless">
    <link rel="icon" href="/images/icon.ico">

    <title>Carousel Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href="/css/select2.css" type='text/css' media='all'/>
    <!-- Custom styles for this template -->
    <link href="/css/data.css" rel="stylesheet">
</head>
<!-- NAVBAR
================================================== -->
<body>
<?php if(!isset($_SESSION)){ session_start();}; ?>
<div class="navbar-wrapper">
    <div class="container">

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Healthier</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">

                    <ul class = "nav navbar-nav navbar-right">
                        <li><a href="/admin/change">更改密码</a></li>
                        <li><a href="/login">登出</a></li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
</div>
<div class="container">
    @yield('content')

    <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2015 nonetheless &middot; <a href="http://weibo.com/u/1787901712" target="_blank">微博</a> &middot; <a href="Mailto:lxin13@software.nju.edu.cn">邮箱</a></p>
    </footer>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/Chart.min.js"></script>
<script src="/js/select2.js"></script>
@yield('js')
</body>
</html>