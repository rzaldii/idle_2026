<?php $__env->startSection('title', 'Mahasiswa'); ?>



<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('app-title', 'Edit Mahasiswa'); ?>
<?php $__env->startSection('app-description', ''); ?>



<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Edit Mahasiswa</h3>
                <form method="post" action="<?php echo e(route('admin.mahasiswa.update', ['mahasiswa' => $mahasiswa->nim])); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <div class="form-group">
                        <label for="titlePost">NIM</label>
                        <input class="form-control" id="titlePost" type="text" value="<?php echo e($mahasiswa->nim); ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="titlePost">Nama</label>
                        <input class="form-control" id="titlePost" type="text" value="<?php echo e($mahasiswa->nama); ?>" name="nama">
                    </div>

                    <div class="form-group">
                        <label for="titlePost">Email</label>
                        <input class="form-control" id="titlePost" type="text"value="<?php echo e($mahasiswa->email); ?>" name="email">
                    </div>

                    <div class="form-group">
                        <label for="titlePost">No HP</label>
                        <input class="form-control" id="titlePost" type="text" value="<?php echo e($mahasiswa->no_hp); ?>" name="no_hp">
                    </div>

                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WEB IDLE 2026\idle_2026\resources\views/admin/pages/edit_mahasiswa.blade.php ENDPATH**/ ?>