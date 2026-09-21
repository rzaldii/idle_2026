<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta name="_token" content="<?php echo e(csrf_token()); ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link href="<?php echo e(asset('favicon/favicon-32x32.png')); ?>" rel="icon">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('favicon/apple-touch-icon.png')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon/favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('favicon/favicon-16x16.png')); ?>">
    <link rel="manifest" href="<?php echo e(asset('favicon/site.webmanifest')); ?>">
    <link rel="mask-icon" href="<?php echo e(asset('favicon/safari-pinned-tab.svg')); ?>" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/admin/css/main.css')); ?>">

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
  	<!-- CKEditor 4 -->
  	<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body class="app sidebar-mini rtl">
<!-- Navbar-->
<?php echo $__env->make('admin.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Sidebar menu-->
<?php echo $__env->make('admin.includes.side-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><?php echo $__env->yieldContent('app-title'); ?></h1>
            <p><?php echo $__env->yieldContent('app-description'); ?></p>
        </div>
    </div>

    <?php echo $__env->yieldContent('content'); ?>
</main>
<!-- Essential javascripts for application to work-->
<script src="<?php echo e(asset('assets/admin/js/jquery-3.2.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/main.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugins/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugins/dataTables.bootstrap.min.js')); ?>"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="<?php echo e(asset('assets/admin/js/plugins/pace.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/plugins/bootstrap-notify.min.js')); ?>"></script>

<script>

    $(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
      });
    });

    function successNotification(title, message) {
        $.notify({
                title: title,
                message: message,
                icon: 'fa fa-check'
            },
            {
                type: 'success'
            }
        );
    }

    function errorNotification(title, message) {
        $.notify({
                title: title,
                message: message,
                icon: 'fa fa-exclamation-triangle'
            },
            {
                type: 'danger'
            }
        );
    }

    <?php if($message = Session::get('success')): ?>
    successNotification('Success : ', "<?php echo e($message); ?>");

    <?php endif; ?>

    <?php if($message = Session::get('error')): ?>
    errorNotification('Error : ', "<?php echo e($message); ?>");

    <?php endif; ?>

</script>


<!-- Page specific javascripts-->
<script type="text/javascript" src="<?php echo e(asset('assets/admin/js/plugins/chart.js')); ?>"></script>
<?php echo $__env->yieldContent('js'); ?>
</body>
</html>
<?php /**PATH D:\WEB IDLE 2026\idle_2026\resources\views/admin/layouts/base.blade.php ENDPATH**/ ?>