<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('beautymail::templates.sunny.heading' , [
        'heading' => 'Selamat',
        'level' => 'h1',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('beautymail::templates.sunny.contentStart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <p><b>Selamat Tim anda telah terdaftar pada Event IDLe dengan nama tim <?php echo e($tim->nama_tim); ?> dalam
            kategori <?php echo e($kategori->nama_kategori); ?> </b></p>

 
    

    <?php if($kategori->kategori == 'cpc'): ?>
        <p>Silahkan tunggu informasi selanjutnya dari email</p>
    <?php else: ?>
        <?php if($kategori->kategori == 'ctf'): ?>
            <p>Wajib masuk ke dalam Discord CTF Laos Arena</p>
            <a href="https://discord.gg/fdVazuuj" style="background-color: #7289da; color: #fff; padding: 10px 20px; text-decoration: none; display: block; border-radius: 5px; text-align: center; margin: auto;">
                Discord
            </a>            
            <p>Silahkan submit write up dengan klik tombol dibawah : </p>
        <?php elseif($kategori->id_ormawa == 1): ?>
            <p>Silahkan submit karya tulis dan poster dengan klik tombol dibawah : </p>
            <?php elseif($kategori->id_ormawa == 2): ?>
                <p>Silahkan submit karya tulis dengan klik tombol di bawah ini : </p>
        <?php else: ?>
            <p>Silahkan submit karya tulis dengan klik tombol dibawah : </p>
        <?php endif; ?>
        <?php echo $__env->make('beautymail::templates.sunny.contentEnd', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('beautymail::templates.sunny.button', [
        	'title' => 'Submit',
        	'link' => route('kompetisi.submit.index', ['kategori' => $kategori->kategori, 'token' => $kode])], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if($kategori->kategori == 'data-mining'): ?>
                <?php echo $__env->make('beautymail::templates.sunny.contentStart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <p> Link Grup Wa :
                    <a href="https://bit.ly/GrupPesertaITeC">Grup WA Peserta ITeC</a>
                </p>
                <?php echo $__env->make('beautymail::templates.sunny.contentEnd', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                
                <?php echo $__env->make('beautymail::templates.sunny.contentStart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <p>atau akses link berikut :
                    <a href="<?php echo e(route('kompetisi.submit.index', ['kategori' => $kategori->kategori, 'token' => $kode])); ?>"><?php echo e(route('kompetisi.submit.index', ['kategori' => $kategori->kategori, 'token' => $kode])); ?></a>
                </p>
                <?php echo $__env->make('beautymail::templates.sunny.contentEnd', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php elseif($kategori->kategori == 'uiux'): ?>
                <?php echo $__env->make('beautymail::templates.sunny.contentStart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <p> Link Grup Wa :
                    <a href="https://bit.ly/GrupPesertaITeC">Grup WA Peserta ITeC</a>
                </p>
                <?php echo $__env->make('beautymail::templates.sunny.contentEnd', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                
                <?php echo $__env->make('beautymail::templates.sunny.contentStart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <p>atau akses link berikut :
                    <a href="<?php echo e(route('kompetisi.submit.index', ['kategori' => $kategori->kategori, 'token' => $kode])); ?>"><?php echo e(route('kompetisi.submit.index', ['kategori' => $kategori->kategori, 'token' => $kode])); ?></a>
                </p>
                <?php echo $__env->make('beautymail::templates.sunny.contentEnd', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('beautymail::templates.sunny.contentStart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <p>atau akses link berikut :
                    <a href="<?php echo e(route('kompetisi.submit.index', ['kategori' => $kategori->kategori, 'token' => $kode])); ?>"><?php echo e(route('kompetisi.submit.index', ['kategori' => $kategori->kategori, 'token' => $kode])); ?></a>
                </p>
                <?php echo $__env->make('beautymail::templates.sunny.contentEnd', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
    <?php endif; ?>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('beautymail::templates.sunny', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WEB IDLE 2026\idle_2026\resources\views/mails/daftar.blade.php ENDPATH**/ ?>