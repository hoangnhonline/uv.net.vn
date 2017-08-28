<!DOCTYPE html>
<html>
<head>
    <title>Log in</title>
    <?php $this->view("component/admin/css_library.php");; ?>
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url('assets/lte/plugins/iCheck/square/blue.css'); ?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><img src="<?php echo base_url('assets/images/logo.png'); ?>" width="50%"></h2></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="#" id="login" method="post">
            <div class="text-center notice" style="color: red;">  </div>
            <div class="form-group has-feedback">
                <input type="text" id="username" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" id="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a href="#">I forgot my password</a><br>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- iCheck -->
<?php $this->view("component/admin/js_library.php");; ?>
<script src="<?php echo base_url('assets/lte/plugins/iCheck/icheck.min.js'); ?>"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });

        $("#login").submit(function(){
            user_info = {username : $("#username").val(), password : $("#password").val()};
            $.ajax({
                url     : API + 'admin/login',
                method  : 'post',
                data    : {info : JSON.stringify(user_info)},
                success : function(html){
                    if(html.length <= 10){
                        $(".notice").text("username or password incorrect!");
                        return;
                    }

                    user = JSON.parse(html);
                    if(user.id !== null){
                        window.location.href = API + "admin/dashboard";
                    } else {
                        $(".notice").text("username or password incorrect!");
                    }
                }
            });
            return false;
        });
    });
</script>
</body>
</html>
