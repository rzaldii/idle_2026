@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Selamat',
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

    <p>Selamat kepada Tim <b>{{ $tim_->nama_tim }}</b>, Tim Anda berhasil lolos ke <b>{{ ucfirst($tahap) }}</b> dalam kategori <b>{{ $kategori->nama_kategori }}</b>.</p>

    @include('beautymail::templates.sunny.contentEnd')

    @if($kategori->kategori == 'cpc')
        @include('beautymail::templates.sunny.contentStart')
        <p>Silahkan tunggu informasi selanjutnya mengenai babak final melalui email atau grup peserta.</p>
        @include('beautymail::templates.sunny.contentEnd')
    @else
        @include('beautymail::templates.sunny.contentStart')
        <p>Silahkan submit karya / berkas babak {{ $tahap }} dengan menekan tombol di bawah ini:</p>
        @include('beautymail::templates.sunny.contentEnd')

        @include('beautymail::templates.sunny.contentStart')
        @include('beautymail::templates.sunny.button', [
            'title' => 'Submit ' . ucfirst($tahap),
            'link' => route('kompetisi.submit.index', ['token' => $kode])
        ])
        @include('beautymail::templates.sunny.contentEnd')

        @include('beautymail::templates.sunny.contentStart')
        <p>atau akses tautan berikut: <a href="{{ route('kompetisi.submit.index', ['token' => $kode]) }}">{{ route('kompetisi.submit.index', ['token' => $kode]) }}</a></p>
        @include('beautymail::templates.sunny.contentEnd')
    @endif

@stop