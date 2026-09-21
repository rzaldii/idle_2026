<?php $__env->startSection('title', 'Post'); ?>



<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('app-title', 'Daftar Post'); ?>
<?php $__env->startSection('app-description', 'Daftar post IDL'); ?>



<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Title</th>
                            <th width="40%">Desc</th>
                            <th width="7%">Author</th>
                            <th width="13%">Created at</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($posts['current_page'] * $posts['per_page'] + ($key + 1)); ?></td>
                            <td><?php echo e($post->title); ?></td>
                            <td><?php echo e(strlen($post->description) > 50 ? substr($post->description, 0, 50) . '...' : $post->description); ?></td>
                            <td><?php echo e($post->user->name); ?></td>
                            <td><?php echo e(date('d/m/Y H:i', strtotime($post->created_at))); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.post.edit', ['post' => $post->id])); ?>" class="btn btn-info">Edit</a>
                                <button onclick="deletePost(<?php echo e($post->id); ?>)" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <?php echo e($posts->links()); ?>

                    </table>
                    <form action="<?php echo e(route('admin.post.destroy', ['post' => -1])); ?>" method="post" id="delete-form">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>
    <script>
        function deletePost(id){
            var c = confirm("Are you sure delete this post?");
            if(c == true){
                url = $('#delete-form').attr('action');
                url = url.substring(0, url.length-2) + id;
                url = $('#delete-form').attr('action', url);
                // return;
                $('#delete-form').submit();
            } else {

            }
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WEB IDLE 2026\idle_2026\resources\views/admin/pages/posts.blade.php ENDPATH**/ ?>