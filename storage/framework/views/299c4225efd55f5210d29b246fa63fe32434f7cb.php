<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/admin/css/main.css')); ?>">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login - IDLe</title>
</head>
<body>
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <h1>IDLe</h1>
    </div>
    <div class="login-box">
        <form class="login-form" action="<?php echo e(route('login')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user-circle-o"></i>SIGN IN</h3>
            <div class="form-group">
                <label class="control-label">EMAIL</label>
                <input class="form-control" type="email" placeholder="Email" autofocus name="email"
                       value="<?php echo e(old('email')); ?>" required>
                <?php if($errors->has('email')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label class="control-label">PASSWORD</label>
                <input class="form-control" type="password" placeholder="Password" name="password" required>
                <?php if($errors->has('password')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('password')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <div class="utility">
                    <div class="animated-checkbox">
                        <label>
                            <input type="checkbox" name="remember"  <?php echo e(old('remember') ? 'checked' : ''); ?>><span class="label-text">Stay Signed in</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
            </div>
        </form>
    </div>
</section>
<!-- Essential javascripts for application to work-->
<script src="<?php echo e(asset('assets/admin/js/jquery-3.2.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/bootstrap.min.js')); ?>"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="<?php echo e(asset('assets/admin/js/plugins/pace.min.js')); ?>"></script>
<script type="text/javascript">
    // Login Page Flipbox control
    $('.login-content [data-toggle="flip"]').click(function () {
        $('.login-box').toggleClass('flipped');
        return false;
    });
</script>
</body>
</html>
<?php /**PATH D:\WEB IDLE 2026\idle_2026\resources\views/auth/login.blade.php ENDPATH**/ ?>