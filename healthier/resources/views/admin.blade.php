<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="nonetheless">
    <link rel="icon" href="../images/icon.ico">

    <title>Carousel Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/login.css" rel="stylesheet">
</head>
<!-- NAVBAR
================================================== -->
<body background="/images/background.jpg">
<div class="site-wrapper">

    <div class="site-wrapper-inner">

        <div class="cover-container">

            <div class="masthead clearfix">
                <div class="inner">
                    <h3 class="masthead-brand">Healthier</h3>
                </div>
            </div>

            <div class="inner cover">
                <h1 class="cover-heading">管理员 医生 教练 登陆</h1>
                <div class="lead">
                    <form class="form-signin" method="POST" action="/login/admincheck">

                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="remember-me"> Remember me
                            </label>
                        </div>

                        <button class="btn btn-lg btn-block" type="submit">Sign in</button>
                        <input type="hidden" name="_token" value={{csrf_token()}} >
                    </form>

                    <div class="mastfoot">
                        <div class="inner">
                            <p>&copy; 2015 nonetheless &middot; <a href="http://weibo.com/u/1787901712" target="_blank">微博</a> &middot; <a href="Mailto:lxin13@software.nju.edu.cn">邮箱</a></p>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</body>

</html>
