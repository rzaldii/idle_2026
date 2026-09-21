<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" style="max-width: 48px;" src="<?php echo e(asset(\Illuminate\Support\Facades\Auth::user()->profile_pict)); ?>" alt="User Image">
        <div>
            <p class="app-sidebar__user-name"><?php echo e(Auth::user()->name); ?></p>
            <p class="app-sidebar__user-designation"><?php echo e(Auth::user()->email); ?></p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item <?php echo e(request()->is('admin') ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview <?php echo e(request()->is('admin/post*') ? 'is-expanded' : ''); ?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-sticky-note"></i><span class="app-menu__label">Post Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item <?php echo e(request()->is('admin/post') ? 'active' : ''); ?>" href="<?php echo e(route('admin.post.index')); ?>"><i class="icon fa fa-circle-o"></i> Posts</a></li>
                <li><a class="treeview-item <?php echo e(request()->is('admin/post/create') ? 'active' : ''); ?>" href="<?php echo e(route('admin.post.create')); ?>"><i class="icon fa fa-circle-o"></i> Create Post</a></li>
                <li><a class="treeview-item <?php echo e(request()->is('admin/post-image') ? 'active' : ''); ?>" href="<?php echo e(route('admin.post-image.index')); ?>"><i class="icon fa fa-circle-o"></i>Upload Image</a></li>
            </ul>
        </li>

        <li class="treeview <?php echo e(request()->is('admin/penyisihan-1/*') ? 'is-expanded' : ''); ?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Kompetisi (Penyisihan 1)</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <?php $__currentLoopData = \App\Kategori::where('id_ormawa', \Illuminate\Support\Facades\Auth::user()->id_ormawa)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a class="treeview-item <?php echo e(request()->is('admin/penyisihan-1/'.$kategori->kategori) ? 'active' : ''); ?>" href="<?php echo e(route('admin.penyisihan-1.index', ['kategori' => $kategori->kategori])); ?>"><i class="icon fa fa-circle-o"></i><?php echo e($kategori->nama_kategori); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li><a class="treeview-item <?php echo e(request()->is('penyisihan-1/set-nilai') ? 'active' : ''); ?>" href="<?php echo e(route('admin.penyisihan-1.set-nilai')); ?>"><i class="icon fa fa-trophy"></i>Set Nilai</a></li>
            </ul>
        </li>
        
        <?php if($kategori->id_ormawa == 1 || $kategori->id_ormawa == 3 ): ?>
            <div></div>
        <?php else: ?>
            <li class="treeview <?php echo e(request()->is('admin/penyisihan-2/*') ? 'is-expanded' : ''); ?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Kompetisi (Penyisihan 2)</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <?php $__currentLoopData = \App\Kategori::where('id_ormawa', \Illuminate\Support\Facades\Auth::user()->id_ormawa)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($kategori->kategori == 'data-mining'): ?>
                            <div></div>
                        <?php else: ?>
                            <li><a class="treeview-item <?php echo e(request()->is('admin/penyisihan-2/'.$kategori->kategori) ? 'active' : ''); ?>" href="<?php echo e(route('admin.penyisihan-2.index', ['kategori' => $kategori->kategori])); ?>"><i class="icon fa fa-circle-o"></i><?php echo e($kategori->nama_kategori); ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <li><a class="treeview-item <?php echo e(request()->is('penyisihan-2/set-nilai') ? 'active' : ''); ?>" href="<?php echo e(route('admin.penyisihan-2.set-nilai')); ?>"><i class="icon fa fa-trophy"></i>Set Nilai</a></li>
                </ul>
            </li>
        <?php endif; ?>
    
        <li class="treeview <?php echo e(request()->is('admin/final/*') ? 'is-expanded' : ''); ?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Kompetisi (Final)</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <?php $__currentLoopData = \App\Kategori::where('id_ormawa', \Illuminate\Support\Facades\Auth::user()->id_ormawa)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a class="treeview-item <?php echo e(request()->is('admin/final/'.$kategori->kategori) ? 'active' : ''); ?>" href="<?php echo e(route('admin.final.index', ['kategori' => $kategori->kategori])); ?>"><i class="icon fa fa-circle-o"></i><?php echo e($kategori->nama_kategori); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li><a class="treeview-item <?php echo e(request()->is('final/set-nilai') ? 'active' : ''); ?>" href="<?php echo e(route('admin.final.set-nilai')); ?>"><i class="icon fa fa-trophy"></i>Set Nilai</a></li>
            </ul>
        </li>
        <li><a class="app-menu__item <?php echo e(request()->is('admin/mahasiswa') ? 'active' : ''); ?>" href="<?php echo e(route('admin.mahasiswa.index')); ?>"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Mahasiswa</span></a></li>
        <li><a class="app-menu__item <?php echo e(request()->is('admin/tim') ? 'active' : ''); ?>" href="<?php echo e(route('admin.tim.index')); ?>"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Tim</span></a></li>
        <li><a class="app-menu__item <?php echo e(request()->is('admin/mail') ? 'active' : ''); ?>" href="<?php echo e(route('admin.mail.page')); ?>"><i class="app-menu__icon fa fa-envelope"></i><span class="app-menu__label">Email</span></a></li>

    </ul>
</aside>
<?php /**PATH D:\WEB IDLE 2026\idle_2026\resources\views/admin/includes/side-menu.blade.php ENDPATH**/ ?>