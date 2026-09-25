<?php $__env->startSection('title', 'IDLe 2026 — ILKOM Developer League'); ?>

<?php $__env->startSection('css'); ?>
    <!-- Google Fonts: Space Grotesk (Heading), Inter (Body), JetBrains Mono (Code/Tag) -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@300;400;500;600&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet" />
    
    <!-- IDLe 2026 Design System (Official Retro Arcade Light Mode Base) -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/idle-design-system.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- ======================================================================
         SECTION 1: HERO (Arcade Synthwave Grid + Neon Glow Highlights)
         ====================================================================== -->
    <section class="section-hero">
        <div class="container hero-content">
            <div class="row align-items-center" id="top">
                <div class="col-12 col-lg-7 col-xl-6">
                    <h1 class="hero-title">
                        IDLe <span class="text-neon-cyan">2026</span>
                        <span class="hero-title-sub">
                            ILKOM <span class="text-neon-cyan">Developer</span> <span class="text-neon-magenta">League</span>
                        </span>
                    </h1>
                    
                    <p class="hero-subtitle">
                        Ajang kompetisi teknologi dan festival inovasi digital tahunan Fakultas Ilmu Komputer Universitas Jember untuk mengasah daya cipta dan talenta muda bangsa.
                    </p>

                    <!-- Powered by Logos (Clean Minimal) -->
                    <div class="hero-powered-by">
                        <p class="hero-powered-title">Powered by</p>
                        <div class="hero-powered-logos">
                            <img src="<?php echo e(asset('assets/img/HIMASIF.png')); ?>" alt="HIMASIF" title="HIMASIF">
                            <img src="<?php echo e(asset('assets/img/HIMATIF.png')); ?>" alt="HIMATIF" title="HIMATIF">
                            <img src="<?php echo e(asset('assets/img/hmif.png')); ?>" alt="HMIF" title="HMIF">
                            <img src="<?php echo e(asset('assets/img/LAOS.png')); ?>" alt="LAOS" title="LAOS">
                        </div>
                    </div>

                    <!-- Call To Action Buttons -->
                    <div class="d-flex flex-wrap align-items-center" style="gap: 14px;">
                        <a href="/faq" class="btn-idle-primary pulse">
                            <i class="fa fa-info-circle"></i> Tentang IDLe
                        </a>
                        <a href="#lomba" class="btn-idle-outline">
                            <i class="fa fa-trophy"></i> Jelajahi Lomba
                        </a>
                    </div>
                </div>

                <!-- Hero Graphic Illustration / Device Mockup -->
                <div class="col-12 col-lg-5 col-xl-6 d-none d-lg-block">
                    <div class="hero-mockup-wrapper">
                        <div class="hero-glow-backdrop"></div>
                        <img class="hero-device-img bounce animated" 
                             src="<?php echo e(asset('assets/img/laning2.png')); ?>" 
                             alt="IDLe 2026 Retro Arcade Device Showcase">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======================================================================
         SECTION 2: BIDANG LOMBA (Retro Pixel Corner Cards + Glow)
         ====================================================================== -->
    <section class="section-wrapper section-wrapper-alt" id="lomba">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Bidang Lomba</h2>
                <p class="section-subtitle">
                    Pilih cabang kompetisi favorit tim Anda dan tunjukkan karya terbaik untuk memperebutkan takhta juara IDLe 2026.
                </p>
            </div>

            <!-- Horizontal Scroll Container for Competition Cards -->
            <div class="competisi-scroll-container">
                <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="competisi-scroll-item">
                    <a href="<?php echo e(route('kompetisi.index', ['kategori' => $kategori->kategori])); ?>" class="card-kompetisi">
                        <div class="card-kompetisi-img-wrap">
                            <img src="<?php echo e(asset('assets/img/kategori/'.$kategori->kategori.'.jpg')); ?>" 
                                 alt="<?php echo e($kategori->nama_kategori); ?>" 
                                 class="card-kompetisi-img"
                                 onerror="this.src='<?php echo e(asset('assets/img/kategori/PPL.jpg')); ?>'">
                        </div>
                        <div class="card-kompetisi-body">
                            <div>
                                <h4 class="card-kompetisi-title"><?php echo e($kategori->nama_kategori); ?></h4>
                            </div>
                            <div class="card-kompetisi-action">
                                <span>Detail Kompetisi</span>
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- ======================================================================
         SECTION 3: BERITA TERBARU (Neon Top Border Cards + Magenta Badges)
         ====================================================================== -->
    <section class="section-wrapper" id="berita">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Berita Terbaru</h2>
                <p class="section-subtitle">
                    Ikuti perkembangan terbaru, panduan teknis babak penyisihan, dan pengumuman resmi seputar IDLe 2026.
                </p>
            </div>

            <?php if(count($posts) > 0): ?>
                <div class="row">
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                        <article class="card-berita w-100">
                            <div class="card-berita-body">
                                <div class="card-berita-meta mb-3">
                                    <span>
                                        <i class="fa fa-calendar-o mr-1 text-neon-cyan"></i> <?php echo e($post->created_at ? $post->created_at->format('d M Y') : '-'); ?>

                                    </span>
                                    <span>
                                        <i class="fa fa-user-circle-o mr-1 text-neon-magenta"></i> <?php echo e($post->user->name ?? 'Panitia'); ?>

                                    </span>
                                </div>
                                <h3 class="card-berita-title">
                                    <a href="<?php echo e(route('post.show', ['post' => $post->id])); ?>" style="color: inherit; text-decoration: none;">
                                        <?php echo e($post->title); ?>

                                    </a>
                                </h3>
                                <?php if(!empty($post->description)): ?>
                                <p class="card-berita-desc">
                                    <?php echo e(\Illuminate\Support\Str::limit(strip_tags($post->description), 120, '...')); ?>

                                </p>
                                <?php endif; ?>
                                <div class="mt-auto pt-3">
                                    <a href="<?php echo e(route('post.show', ['post' => $post->id])); ?>" class="card-berita-link">
                                        <span>Baca Selengkapnya</span>
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Pagination matching Neon Design Tokens -->
                <div class="idle-pagination-wrapper">
                    <?php echo e($posts->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <div class="mb-3" style="font-size: 2.75rem; color: var(--color-text-muted);">
                        <i class="fa fa-newspaper-o"></i>
                    </div>
                    <h4 style="color: var(--color-text-muted);">Belum ada berita yang dipublikasikan</h4>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- ======================================================================
         SECTION 4: PARTNERS & EVENTS SHOWCASE (Retro Arcade Banner)
         ====================================================================== -->
    <section class="section-partners-arcade">
        <div class="container">
            <div class="partners-arcade-box">
                <div class="partner-logo-item" title="BITS">
                    <img src="<?php echo e(asset('assets/img/BITS.png')); ?>" alt="BITS">
                </div>
                <div class="partner-logo-item" title="ITEC">
                    <img src="<?php echo e(asset('assets/img/ITEC.png')); ?>" alt="ITEC">
                </div>
                <div class="partner-logo-item" title="ICOM">
                    <img src="<?php echo e(asset('assets/img/icom.png')); ?>" alt="ICOM">
                </div>
                <div class="partner-logo-item" title="LAOS ARENA">
                    <img src="<?php echo e(asset('assets/img/laos_arena.png')); ?>" alt="LAOS ARENA">
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\idle_2026\resources\views/pages/home.blade.php ENDPATH**/ ?>