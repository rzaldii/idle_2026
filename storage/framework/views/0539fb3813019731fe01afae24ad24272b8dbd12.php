<?php $__env->startSection('title', 'IDLe'); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .container{
          margin-top: 20pt;
          margin-bottom: 25pt;
        }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/feed.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="header-blue">
      <div class="container hero" style="margin-top: 0px;">
          <div class="row" id="top">
              <div class="col-12 col-lg-6 col-xl-5 offset-xl-1 bounce animated">
                  <h1 style="color: rgb(0,0,0);margin-top: 93px;font-family: Nunito, sans-serif;font-style: normal;font-weight: bold;">ILKOM Developer League</h1>
                  <br><br><br><br>
                  
                  <p style="color: rgba(0,0,0,0.8);font-family: Nunito, sans-serif;">Powered by</p>
                  <div style="margin-top: -31px;">
                      <div class="row">
                          <div class="col-3 col-md-3" style="padding-right: 0px;padding-left: 0px;"><img src="assets/img/HIMASIF.png" style="height: 80px;"></div>
                          <div class="col-3 col-md-3" style="padding-left: 0px;padding-right: 0px;"><img src="assets/img/HIMATIF.png" style="height: 87px;"></div>
                          <div class="col-3 col-md-3" style="padding-left: 0px;padding-right: 0px;"><img src="assets/img/hmif.png" style="height: 87px;"></div>
                          <div class="col-3 col-md-3" style="padding-left: 0px;padding-right: 0px;"><img src="assets/img/LAOS.png" style="height: 71px;"></div>
                      </div>
                  </div>
                  <a href="/faq" class="btn btn-success shadow" data-bs-hover-animate="pulse" style="margin-top: 13px;"> Tentang IDLe</a>
              </div>
              <div class="col-md-5 col-lg-5 offset-lg-1 offset-xl-0 d-none d-lg-block phone-holder">
                  <div class="iphone-mockup">
                      <img class="bounce animated device" src="assets/img/laning2.png" style="width: 402px;">
                  </div>
              </div>
          </div>
        </div>
    </div>

    <div style="padding-botom: 45px;">
        <div class="row">
            <div class="col-md-4 align-self-center">
                <h1 class="text-center" style="color: rgb(0,0,0);font-family: Nunito, sans-serif;font-weight: bold;">Bidang Lomba</h1>
                <!-- <p class="text-center">Lorem Ipsum Dolor lur</p> -->
            </div>
            <div class="col-md-8" style="padding-bottom: 20px;">
                <div class="d-flex flex-row multiple-item-slider" style="margin-top: 18px;width: auto;height: auto;">
                    <section class="horitzontalScroll">
                        <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('kompetisi.index', ['kategori' => $kategori->kategori])); ?>" style="margin-right: 0px;width: auto;height: auto;">
                            <div class="horitzontalScrollContent mr-3 ml-2">
                                <div class="card shadow">
                                    <div class="card-body"><img src="<?php echo e(asset('assets/img/kategori/'.$kategori->kategori.'.jpg')); ?>" style="height: 194px;">
                                        <h4 class="text-center card-title" style="color: rgb(0,0,0);font-family: Nunito, sans-serif;font-style: normal;font-weight: bold;margin-top: 7px;"><?php echo e($kategori->nama_kategori); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div class="container mtb" id="berita">
        <div class="row">
            <div class="col-md-12 align-self-center">
                <h1 class="text-center" style="color: rgb(0,0,0);font-family: Nunito, sans-serif;font-weight: bold;">Berita Terbaru</h1>
            </div>
            <div class="col-lg-12">
              <section class="feeds row">
              <?php if(count($posts) > 0): ?>
                  <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <article class="feed feed">
                            <div class="feed__img"></div>
                            <a href="<?php echo e(route('post.show', ['post' => $post->id])); ?>" class="feed_link">
                              <?php if( $post->tumbnail != null ): ?>
                                <div class="feed__img--hover" style="background-image: url('<?php echo e($post->tumbnail); ?>')"></div>
                              <?php else: ?>
                                <div class="feed__img--hover" style="background-image: url('<?php echo e(asset('assets/img/kategori/'.$post->kategori.'.jpg')); ?>')"></div>
                              <?php endif; ?>
                             </a>
                            <div class="feed__info">
                              <span class="feed__category"><?php echo e($post->kategori); ?></span>
                              <h3 class="feed__title"><?php echo e($post->title); ?></h3>
                              <span class="feed__by">by <a href="#" class="feed__author" title="author"><?php echo e($post->user->name); ?></a></span>
                            </div>
                        </article>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </section>
              <?php else: ?>
                  <h3 style="text-align: center; opacity: 0.4">Belum ada berita yang dibuat</h3>
              <?php endif; ?>
              <?php echo e($posts->links()); ?>


            </div>
        </div>
    </div>

    <div class="box-event" style="width: 100vw; height: 100px; overflow: hidden">
        <div class="d-flex flex-row justify-content-center">
                <img class="events" src="<?php echo e(asset('assets/img/BITS.png')); ?>" alt="" style="width: auto !important; height: 40px !important;">
                <img class="events" src="<?php echo e(asset('assets/img/ITEC.png')); ?>" alt="" style="width: auto !important; height: 40px !important;">
                <img class="events" src="<?php echo e(asset('assets/img/icom.png')); ?>" alt="" style="width: auto !important; height: 40px !important;">
                <img class="events" src="<?php echo e(asset('assets/img/laos_arena.png')); ?>" alt="" style="width: auto !important; height: 40px !important;">
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WEB IDLE 2026\idle_2026\resources\views/pages/home.blade.php ENDPATH**/ ?>