<?php $__env->startSection('title', 'Post'); ?>



<?php $__env->startSection('css'); ?>
    <!-- Include external CSS. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
<?php $__env->stopSection(); ?>



<?php $__env->startSection('app-title', 'Tambah Post'); ?>
<?php $__env->startSection('app-description', ''); ?>



<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Create Post</h3>
                <form method="post" action="<?php echo e(route('admin.post.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="titlePost">Title Post</label>
                        <input class="form-control" id="titlePost" type="text" aria-describedby="titleHelp" name="title"
                               placeholder="Enter Title" required>
                        <small class="form-text text-muted" id="titleHelp">
                            For Post title
                        </small>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="titlePost">Category</label>
                                <select class="form-control" name="kategori">
                                      <option value="0"disabled>--Select Category--</option>
                                      <option value="Umum" selected>Umum</option>
                                    <?php $__currentLoopData = \App\Kategori::where('id_ormawa', \Illuminate\Support\Facades\Auth::user()->id_ormawa)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option value="<?php echo e($kategori->kategori); ?>"><?php echo e($kategori->nama_kategori); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-9">
                                <label for="tumbnail">Tumbnail URL</label>
                                <input class="form-control" id="tumbnail" type="text" aria-describedby="tumbnail" name="tumbnail"
                                       placeholder="Image URL for Tumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="postDescription">Description</label>
                        <textarea class="form-control" name="description" rows="10" id="editor" required></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Publish
                    </button>
                </form>
            </div>
        </div>
    </div>
	<script>
      	// CKEditor
    	CKEDITOR.replace( 'editor' );
	</script>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WEB IDLE 2026\idle_2026\resources\views/admin/pages/create_post.blade.php ENDPATH**/ ?>