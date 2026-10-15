@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading', [
        'heading' => 'PENGUMUMAN LOLOS BABAK FINAL IDLe 2026',
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

        <p>Halo, Tim <b>{{ $tim_->nama_tim }}</b>!</p>

        <p><b>Selamat!</b></p>

        <p>Kami mengucapkan selamat kepada tim Anda yang berhasil lolos ke <b>Babak Final IDLe 2026 (ILKOM Developer League)</b> pada cabang lomba <b>{{ $kategori->nama_kategori }}</b>.</p>

        <p>Terima kasih atas kerja keras, kreativitas, dan dedikasi yang telah ditunjukkan selama mengikuti kompetisi ini. Perjalanan tim Anda masih berlanjut, dan kini saatnya mempersiapkan karya terbaik untuk babak final!</p>

        <p>Untuk mengikuti tahap selanjutnya, silakan kumpulkan karya atau berkas final melalui tautan berikut:</p>

    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.contentStart')
    @include('beautymail::templates.sunny.button', [
        'title' => 'Submit Karya Final',
        'link' => route('kompetisi.submit.index', ['token' => $tim_->submissionid])
    ])
    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.contentStart')
        <p>🔗 <i>Submit Karya Final:</i><br>
        <a href="{{ route('kompetisi.submit.index', ['token' => $tim_->submissionid]) }}">{{ route('kompetisi.submit.index', ['token' => $tim_->submissionid]) }}</a></p>

        <p>Mohon pastikan karya atau berkas yang dikumpulkan telah sesuai dengan ketentuan babak final yang berlaku.</p>

        <br>
        <p>Salam hangat,</p>
        <p><b>Panitia IDLe 2026</b><br>
        Fakultas Ilmu Komputer<br>
        Universitas Jember</p>

    @include('beautymail::templates.sunny.contentEnd')

@stop
