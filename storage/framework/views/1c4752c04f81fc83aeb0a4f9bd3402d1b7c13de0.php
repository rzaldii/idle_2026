<?php $__env->startSection('title', 'Daftar Tim ' . $kategori->nama_kategori); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<style media="screen">
  body{
    background-color: #F3F2F0;
  }
  .card{
    border-radius: 10px;
    padding: 25px 10%;
    min-height: 500px;
  }
  h2{
    text-align: center;
  }
  thead{
    background-color: var(--primer);
  }
  /* stupid css */
  #peserta_length,
  #peserta_info{
    display: none;
  }
  #peserta_filter,
  .pagination{
    display: flex;
    flex-direction: row;
    justify-content: flex-end;
  }
  .page-item.active .page-link{
    background-color: var(--primer);
    border-color: transparent;
  }
  .page-link{
    color: var(--primer);
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container hero" style="margin-top: 1px;">
        <div class="row">
            <div class="col-md-12" style="height: auto;padding-top: 62px;">
                <div style="margin-bottom: 11px;">
                    <h1  style="color: rgb(0,0,0);margin-top: 71px;, sans-serif;"></h1>
                    <h1 class="text-center page_title">Daftar Peserta <?php echo e($kategori->nama_kategori); ?></h1>
                </div>
            </div>
        </div>
    </div>

    <!-- *****************************************************************************************************************
       DESCRIPTION
       ***************************************************************************************************************** -->
   <div class="card">
       <div class="card-body">
           <div class="container mtb">
               <div class="row">
                   <div class="col-sm-12 col-lg-offset-2">
                     <?php if($babak != 1): ?>
                        <h2>Berikut adalah daftar peserta <?php echo e($kategori->nama_kategori); ?> yang masuk pada babak <?php echo e($babak); ?> dengan nilai pada babak sebelumnya</h2>
                     <?php endif; ?>
                       <?php if(count($tims) > 0): ?>
                           <table class="table table-striped" id="peserta">
                               <thead>
                               <tr>
                                   <th width="5%" scope="col">#</th>
                                   <th width="%" scope="col">Nama</th>
                                   <th width="20%" scope="col">Score</th>
                               </tr>
                               </thead>
                               <tbody>
                               <?php $__currentLoopData = $tims; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <tr>
                                   <th scope="row"><?php echo e($key+1); ?></th>
                                   <td><?php echo e($tim->nama_tim); ?></td>
                                   <td><?php echo e(isset($tim->nilai[0]->nilai) ? $tim->nilai[0]->nilai : '-'); ?></td>
                               </tr>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </tbody>

                           </table>
                       <?php else: ?>
                           <h3 style="text-align: center; opacity: 0.4">Belum ada peserta dalam
                               kategori <?php echo e($kategori->nama_kategori); ?></h3>
                       <?php endif; ?>
                   </div>

                   <?php echo e($tims->links()); ?>

               </div>
           </div>
       </div>
   </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets/admin/js/plugins/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/plugins/dataTables.bootstrap.min.js')); ?>"></script>
    <script type="text/javascript">
    $(document).ready(function () {
        $('#peserta').DataTable({
          "order": [[ 2, "desc" ]],
          "columns": [
            null,
            { "orderable": false },
            null,
          ]});
        $('.dataTables_length').addClass('bs-select');

      });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WEB IDLE 2026\idle_2026\resources\views/pages/peserta.blade.php ENDPATH**/ ?>