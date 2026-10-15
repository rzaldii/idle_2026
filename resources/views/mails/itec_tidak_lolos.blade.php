@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading', [
        'heading' => 'Terima Kasih',
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

        <p>Halo, Tim <b>{{ $tim_->nama_tim }}</b>!</p>

        <p>Terima kasih telah berpartisipasi dalam ajang <b>IDLe 2026 (ILKOM Developer League)</b> pada cabang lomba <b>{{ $kategori->nama_kategori }}</b>. Kami mengapresiasi waktu, usaha, dedikasi, dan karya yang telah Anda dan seluruh anggota tim persiapkan selama mengikuti kompetisi ini.</p>

        <p>Berdasarkan hasil penilaian dan pertimbangan dewan juri, dengan berat hati kami sampaikan bahwa tim Anda <b>belum berhasil melaju ke Babak Final IDLe 2026</b>.</p>

        <p>Meskipun demikian, kami berharap pengalaman dan proses yang telah dilalui dapat menjadi bekal berharga untuk terus belajar, mengembangkan ide, serta menghasilkan karya yang lebih baik ke depannya. Jangan berkecil hati, karena masih banyak kesempatan lain untuk terus bertumbuh dan berprestasi.</p>

        <p>Sebagai bentuk apresiasi atas partisipasi tim, <b>E-Sertifikat Kepesertaan</b> akan segera kami proses. Informasi mengenai tautan pengunduhan sertifikat akan disampaikan melalui grup resmi peserta.</p>

        <p>Terima kasih telah menjadi bagian dari IDLe 2026. Tetap semangat berkarya dan sampai jumpa di kesempatan berikutnya!</p>

        <br>
        <p>Salam hangat,</p>
        <p><b>Panitia IDLe 2026</b><br>
        Fakultas Ilmu Komputer<br>
        Universitas Jember</p>

    @include('beautymail::templates.sunny.contentEnd')

@stop
