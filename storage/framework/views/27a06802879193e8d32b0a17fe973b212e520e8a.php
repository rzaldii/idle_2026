<?php $__env->startSection('title', 'Mahasiswa'); ?>



<?php $__env->startSection('css'); ?>
    
<?php $__env->stopSection(); ?>



<?php $__env->startSection('app-title', 'Daftar mahasiswa'); ?>
<?php $__env->startSection('app-description', 'Daftar mahasiswa yang mengikuti IDLe'); ?>



<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="form-group">
                    <a href="<?php echo e(route('admin.export.mahasiswas')); ?>"
                       class="btn btn-success"><span class="fa fa-file-excel-o"></span>Cetak XLS</a>
                </div>
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="tim-table">
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="13%">NIM</th>
                            <th width="">Nama</th>
                            <th width="">Email</th>
                            <th width="15%">No HP</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                    
                    
                    
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
                ajax: "<?php echo e(route('admin.ajax.mahasiswa')); ?>",
                columns: [
                    {data: 'no'},
                    {
                        data: 'nim',
                        render: function (data, row, type) {
                            return "<a href='/admin/mahasiswa/" + data + "'" + ">" + data + "</a>";
                        }
                    },
                    {data: 'nama'},
                    {data: 'email'},
                    {data: 'no_hp'},
                    {
                        data: 'nim',
                        render: function (data, type, row) {
                            content = "<a href='/admin/mahasiswa/" + data + "/edit'" + "class='btn btn-info'>Edit</a>";
                            // content += "<button onclick=\"deletePost(" + data + ")\" class=\"btn btn-danger\">Delete</button>";
                            return content;
                        }
                    }
                ]
            });
        });
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WEB IDLE 2026\idle_2026\resources\views/admin/pages/mahasiswa.blade.php ENDPATH**/ ?>