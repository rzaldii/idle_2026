<?php $__env->startSection('title', 'Mail'); ?>



<?php $__env->startSection('css'); ?>
    <?php echo csrf_field(); ?>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('app-title', 'Kirim Email'); ?>
<?php $__env->startSection('app-description', ''); ?>



<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3>Tim</h3>

                <form action="<?php echo e(route('admin.mail.tim')); ?>" method="post">
                    <?php echo csrf_field(); ?>

                    <label for="tim-select">Nama Tim</label>
                    <select class="form-control" id="tim-select" multiple="" name="tims[]">
                        <optgroup label="Nama Tim">
                            <?php $__currentLoopData = $tims; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($tim->id); ?>"><?php echo e($tim->nama_tim); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </optgroup>
                    </select>
                    <br>
                    <div class="form-group">
                        <label for="postDescription">Pesan</label>
                        <textarea class="form-control" name="pesan" rows="10" required></textarea>
                    </div>

                    <button class="btn btn-primary" type="submit"><i class=""></i>Kirim</button>

                </form>
            </div>
        </div>


        <div class="col-md-6">
            <div class="tile">
                <h3>Mahasiswa</h3>
                <form action="<?php echo e(route('admin.mail.mahasiswa')); ?>" method="post">
                    <?php echo csrf_field(); ?>

                    <label for="tim-select">Nama Mahasiswa</label>
                    <select class="form-control" id="mahasiswa-select" multiple="" name="emails[]">
                        <optgroup label="Nama Mahasiswa">
                            <?php $__currentLoopData = $mahasiswas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mahasiswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($mahasiswa->email); ?>"><?php echo e($mahasiswa->nim . ' - ' . $mahasiswa->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </optgroup>
                    </select>
                    <br>
                    <div class="form-group">
                        <label for="postDescription">Pesan</label>
                        <textarea class="form-control" name="pesan" rows="10" required></textarea>
                    </div>

                    <button class="btn btn-primary" type="submit"><i class=""></i>Kirim</button>
                </form>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>
    <script type="text/javascript" src="<?php echo e(asset('assets/admin/js/plugins/select2.min.js')); ?>"></script>

    <script>
        $('#mahasiswa-select').select2();
    </script>

    <script>
        $('#tim-select').select2();
    </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WEB IDLE 2026\idle_2026\resources\views/admin/pages/mail.blade.php ENDPATH**/ ?>