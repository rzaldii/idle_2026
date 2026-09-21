<?php $__env->startSection('title', 'Tim'); ?>



<?php $__env->startSection('css'); ?>
    
<?php $__env->stopSection(); ?>



<?php $__env->startSection('app-title', 'Daftar tim'); ?>
<?php $__env->startSection('app-description', 'Daftar tim yang mengikuti IDLe'); ?>



<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="form-group">
                    <a href="<?php echo e(route('admin.export.tims')); ?>"
                       class="btn btn-success"><span class="fa fa-file-excel-o"></span>Cetak XLS</a>
                </div>
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="tim-table">
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Nama Tim</th>
                            <th width="">Ketua Tim</th>
                            <th width="5%">Babak</th>
                            <th width="10%">Kategori</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                    <form action="<?php echo e(route('admin.tim.destroy', ['tim' => -1])); ?>" method="post" id="delete-form">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('POST'); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>
    
    <script>
        function deletePost(id) {
            var c = confirm("Are you sure delete this tim?");
            if (c == true) {
                url = $('#delete-form').attr('action');
                url = url.substring(0, url.length - 2) + id;
                url = $('#delete-form').attr('action', url);
                // return;
                $('#delete-form').submit();
            } else {

            }
        }
    </script>

    <script>
        $(document).ready(function () {
            $('#tim-table').DataTable({
                processing: false,
                serverSide: true,
                responsive: true,
                ajax: "<?php echo e(route('admin.ajax.tim')); ?>",
                columns: [
                    {data: 'no'},
                    {data: 'nama_tim'},
                    {data: 'mahasiswa.nama'},
                    {data: 'babak'},
                    {data: 'kategori.nama_kategori'},
                    {
                        data: 'id',
                        render: function (data, type, row) {
                          content = "<a href=\"/admin/tim/" + data +"/edit/\" class=\"btn btn-sm btn-info fa fa-pencil\" title='Edit tim' data-toggle='tooltip'></a>";
                          content += "<button onclick=\"deletePost(" + data + ")\" class=\"btn btn-sm btn-danger fa fa-trash\" title='Hapus' data-toggle='tooltip'></button> </center>";
                            return content;
                        }
                    }
                ]
            });
        });
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WEB IDLE 2026\idle_2026\resources\views/admin/pages/tims.blade.php ENDPATH**/ ?>