<?php $__env->startSection('title', 'Penyisihan 2'); ?>



<?php $__env->startSection('css'); ?>
    
<?php $__env->stopSection(); ?>



<?php $__env->startSection('app-title', $kategori->nama_kategori); ?>
<?php $__env->startSection('app-description', 'Daftar peserta ' . $kategori->nama_kategori . ' tahap 2'); ?>



<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="form-group">
                    <a href="<?php echo e(route('admin.penyisihan-2.create', ['kategori' => $kategori->kategori ])); ?>"
                       class="btn btn-primary"><span class="fa fa-plus"></span>Tambah Peserta Penyisihan 2</a>
                    <a href="<?php echo e(route('admin.export.penyisihan-2', ['kategori' => $kategori->id])); ?>"
                       class="btn btn-success"><span class="fa fa-file-excel-o"></span>Cetak XLS</a>
                </div>
                <div class="tile-body">

                    <table class="table table-hover table-bordered" id="tim-table">
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Nama Tim</th>
                            <th width="15%">Ketua Tim</th>
                            <th width="%">Anggota</th>
                            <th width="10%">Video</th>
                            <th width="10%">Submission</th>
                            <th width="5%">Tandai</th>
                            <th width="5%">Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        </tbody>

                    </table>
                    <form action="<?php echo e(route('admin.penyisihan-2.destroy', ['tim' => -1, 'kategori' => $kategori->kategori ])); ?>"
                          method="post" id="delete-form">
                        <?php echo csrf_field(); ?>
                    </form>
                    <form action="<?php echo e(route('admin.tim.tandai', ['tim' => 2])); ?>"
                          method="post" id="tandai-tim">
                        <?php echo method_field('POST'); ?>
                        <?php echo csrf_field(); ?>
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
        function tandaiTim(id) {
            url = $('#tandai-tim').attr('action');
            url = url.substring(0, url.length-1) + id;
            url = $('#tandai-tim').attr('action', url);
            $('#tandai-tim').submit();
        }
    </script>

    <script>
        $(document).ready(function () {
            var kategoriId = <?php echo e($kategori->id); ?>;
            var isKategoriPAP = kategoriId === 2;
            $('#tim-table').DataTable({
                processing: false,
                serverSide: true,
                responsive: true,
                ajax: "<?php echo e(route('admin.ajax.penyisihan2', ['kategori' => $kategori->id])); ?>",
                columns: [
                    {data: 'no'},
                    {data: 'nama_tim'},
                    {
                        data: 'mahasiswa',
                        render: function (data, type, row) {
                            return "<a href='/admin/mahasiswa/" + data['nim'] + "'" + ">" + data['nama'] + "</a>"
                        }
                    },
                    {
                        data: 'pesertas',
                        render: function (data, type, row) {
                            content = "";
                            for (var i = 0; i < data.length; i++) {
                                content += "<a href='/admin/mahasiswa/" + data[i]['nim'] + "'" + ">" + data[i]['mahasiswa']['nama'] + "</a>";

                                content = i != data.length - 1 ? content += ", " : content;
                            }
                            return content;
                        }
                    },
                    {
                        data: 'submission.data',
                        render: function (data_, type, row) {
                            if (data_ != null) {
                                data = JSON.parse(data_.replace(/&quot;/g,'"'));
                                return '<a href="' + data.link + '" class="align-items-center">' + data.link + '</a>';
                            } else {
                                return "Link Tidak Tersedia";
                            }
                        }
                    },
                    {
                        data: 'submission',
                        render: function (data_, type, row) {
                            if (!isKategoriPAP) {
                                if (data_ != null) {
                                    console.log(data_);
                                    return '<a href="/admin/ajax/download/' + data_['token'] + '" class="align-items-center"><i class="fa fa-download" aria-hidden="true"></i> Unduh</a>';
                                } else {
                                    return "Belum Melakukan Submission";
                                }
                            } else {
                                if (data_ != null) {
                                console.log(data_.file_path);
                                    data = JSON.parse(data_.file_path.replace(/&quot;/g,'"'));
                                    return '<a href="' + data.link2 + '" class="align-items-center">' + data.link2 + '</a>';
                                } else {
                                    return "Link Tidak Tersedia";
                                }
                            }
                        }
                    },
                    // {
                    //     data: 'submission.file_path',
                    //     render: function (data_, type, row) {
                    //         if (isKategoriPAP == false) {
                    //             console.log(data);
                    //             if (data_ != null) {
                    //                 data = JSON.parse(data_.replace(/&quot;/g,'"'));
                    //                 return '<a href="' + data.link2 + '" class="align-items-center">' + data.link2 + '</a>';
                    //             } else {
                    //                 return "Link Tidak Tersedia";
                    //             }
                    //         } else {
                    //             if (data_ != null) {
                    //                 console.log(data_);
                    //                 return '<a href="/admin/ajax/download/' + data['token'] + '" class="align-items-center"><i class="fa fa-download" aria-hidden="true"></i> Unduh</a>';
                    //             } else {
                    //                 return "Belum Melakukan Submission";
                    //             }
                    //         }
                    //     }
                    // },
                    {   data: 'starred',
                        render: function (data, type, row) {
                            if (data == 0) {
                                return "<center><span class='badge badge-light'><i class='fa fa-star-o' title='Tidak ditandai' data-toggle='tooltip'> </i></span></center>";
                            } else {
                                return "<center><span class='badge badge-warning'><i class='fa fa-star' title='Ditandai' data-toggle='tooltip'> </i></span></center>";
                            }

                        }
                    },
                    {
                        data: 'id',
                        render: function (data, type, row) {
                            content = "<center> <button onclick=\"tandaiTim(" + data + ")\" class=\"btn btn-sm btn-warning fa fa-star\" title='Toogle tanda' data-toggle='tooltip'></button>";
                            content += "<a href=\"/admin/tim/" + data +"/edit/\" class=\"btn btn-sm btn-info fa fa-pencil\" title='Edit tim' data-toggle='tooltip'></a>";
                            content += "<button onclick=\"deletePost(" + data + ")\" class=\"btn btn-sm btn-danger fa fa-trash\" title='Hapus' data-toggle='tooltip'></button> </center>";
                            return content;
                        }
                    }
                ]
            });
        });
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WEB IDLE 2026\idle_2026\resources\views/admin/pages/penyisihan_2.blade.php ENDPATH**/ ?>