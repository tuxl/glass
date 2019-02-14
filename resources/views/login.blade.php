<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>登录</title>

        <!-- Styles -->
        <style>
            *{
                margin: 0;
                padding: 0;
            }
            *, :after, :before {
                box-sizing: border-box;
            }
            body{
                background: #f7f7f7;
            }
            .login{
                margin: 0 auto;
                width: 350px;
                margin-top: 25vh;
            }
            .login h1{
                position: relative;
                color: #73879C;
                font: 400 25px Helvetica,Arial,sans-serif;
                text-align: center;
                text-shadow: 0 1px 0 #fff;
                margin-bottom: 15px;
            }
            .login h1:before, .login h1:after {
                position: absolute;
                content: "";
                height: 1px;
                width: 20%;
                top: 10px;
                background: #7e7e7e;
            }

            .login h1:before{
                left: 0;
            }

            .login h1:after{
                right: 0;
            }

            .login input{
                width: 100%;
                margin-bottom: 15px;
                border-radius: 3px;
                border: 1px solid #c8c8c8;
                color: #777;
                box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,.08) inset;
                display: block;
                height: 34px;
                padding: 6px 12px;
            }
            .login input:focus{
                background-color: #fff;
                border: 1px solid #A878AF;
                outline: 0;
            }
            .btn{
                font-size: 12px;
                margin: 10px 15px 0 0;
                text-decoration: none;
                cursor: pointer;
                border-radius: 3px;
                color: #333;
                background-color: #fff;
                display: inline-block;
                padding: 6px 12px;
                font-weight: 400;
                line-height: 1.42857143;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                border:solid 1px #ccc;
            }

            .btn:hover {
                color: #333;
                background-color: #e6e6e6;
                border-color: #adadad;
            }
        </style>
    </head>
    <body>
        <div class="login">
            <form method="post" id="loginform" action="/loginsubmit">
                <h1>Login Form</h1>
                <div>
                    <input id="name" name="username" placeholder="用户名">
                </div>
                <div>
                    <input id="psw" type="password" name="password"  placeholder="密码">
                </div>
                <div style="color: red">
                    {{ $err }}
                </div>
                <div style="text-align: center">
                    {{ csrf_field() }}
                    <a class="btn" onclick="login()">&nbsp;登&nbsp;录&nbsp;</a>
                </div>
            </form>
        </div>
    </body>
    <script src="static/vendor/jquery.js"></script>
    <script>
        function login() {
            $('#loginform').submit();
        }
    </script>
</html>
