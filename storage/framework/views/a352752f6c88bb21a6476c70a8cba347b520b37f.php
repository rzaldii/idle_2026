<?php $__env->startSection('title', 'Admin Dashboard'); ?>


<style media="screen">
.tile {
  overflow-x: auto;
}
</style>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('app-title', 'Dashboard'); ?>
<?php $__env->startSection('app-description', 'Dashboard untuk ' . \Illuminate\Support\Facades\Auth::user()->name); ?>



<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Total Peserta IDL</h3>
                <?php echo $totalPesertaChart->container(); ?>

            </div>
        </div>

        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Total Tim</h3>
                <?php echo $totalTimChart->container(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>

    <?php echo $totalTimChart->script(); ?>

    <?php echo $totalPesertaChart->script(); ?>


    <script>



        
            
            
            
            
            
                
            
        

        
        

        
            
                
                
                
                
            
            
                
                
                
                
            
            
                
                
                
                
            
        

        // var ctxp = $("#timChart").get(0).getContext("2d");
        // var pieChart = new Chart(ctxp).Pie(data);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WEB IDLE 2026\idle_2026\resources\views/admin/pages/dashboard.blade.php ENDPATH**/ ?>