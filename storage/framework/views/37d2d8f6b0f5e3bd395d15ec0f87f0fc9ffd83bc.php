<nav class="navbar navbar-light navbar-expand-md fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img id="brand-logo" src="<?php echo e(asset('assets/img/logo_idle.png')); ?>" style="height: 44px;">
        </a>
        <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active navitem" href="/#berita">Berita</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Bidang Lomba</a>
                    <div class="dropdown-menu" role="menu">
                        <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="dropdown-item" role="presentation" href="<?php echo e(route('kompetisi.index', ['kategori' => $kategori->kategori])); ?>"><?php echo e($kategori->nama_kategori); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link active navitem" href="/faq">FAQ</a>
                </li>
            </ul>
        </div>
    </div>
</nav><?php /**PATH E:\idle_2026\resources\views/includes/navbar.blade.php ENDPATH**/ ?>