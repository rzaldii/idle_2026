<?php $__env->startSection('title', 'Nilai'); ?>



<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('app-title', 'Nilai Tahap 1'); ?>
<?php $__env->startSection('app-description', ''); ?>



<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="title">Set Nilai <?php echo e($tahap); ?></h3>
                </div>

                <div class="tile-body">
                    <form action="" method="post" id="nilai-form">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label for="">Nama Tim</label>
                            <select class="form-control" id="tim-select" name="tim">
                                <optgroup label="Nama Tim">
                                    <option value="-1">Pilih Tim</option>
                                    <?php $__currentLoopData = $tims; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tim->id); ?>"><?php echo e($tim->nama_tim); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </optgroup>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Nilai</label>
                            <input class="form-control" type="text" name="nilai" placeholder="Masukan Nilai" id="nilai">
                        </div>
                        <input type="hidden" name="babak" value="<?php echo e($babak); ?>" id="babak-value">
                        <div class="tile-footer">
                            <button class="btn btn-primary" type="button" name="submit" id="submit-btn">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>
    <script>
        $('#tim-select').change(function () {
            $.ajax({
                type: 'GET',
                url: '/admin/ajax/nilai/' + this.value + '/' + $('#babak-value').val(),
                success: function (data) {
                    $('#nilai').val(data);
                },
                error: function(){
                    $('#nilai').val('');
                }
            });
        });

        $('#submit-btn').click(function (xhr, textStatus, errorThrown) {
            $.ajax({
                type: 'POST',
                url: '/admin/ajax/nilai',
                data: $('#nilai-form').serialize(),
                success: function(data){
                    if(data == true){
                        successNotification('Success', 'Data berhasil ditambahkan');
                    } else {
                        errorNotification('Failed', 'Something Error');
                    }

                    $('#tim-select').val(-1)
                    $('#nilai').val('');
                },
                error: function(a, b, c){
                    errorNotification('Error', 'Something Error');

                    $('#tim-select').val(-1)
                    $('#nilai').val('');
                }
            });
            console.log();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WEB IDLE 2026\idle_2026\resources\views/admin/pages/set_nilai.blade.php ENDPATH**/ ?>