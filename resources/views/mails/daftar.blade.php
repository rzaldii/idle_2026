@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Selamat',
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

    <p><b>Selamat Tim anda telah terdaftar pada Event IDLe dengan nama tim {{ $tim->nama_tim }} dalam
            kategori {{ $kategori->nama_kategori }} </b></p>

 
    

    @if($kategori->kategori == 'cpc')
        <p>Silahkan tunggu informasi selanjutnya dari email</p>
    @else
        @if ($kategori->kategori == 'ctf')
            <p>Wajib masuk ke dalam Discord CTF Laos Arena</p>
            <a href="https://discord.gg/fdVazuuj" style="background-color: #7289da; color: #fff; padding: 10px 20px; text-decoration: none; display: block; border-radius: 5px; text-align: center; margin: auto;">
                Discord
            </a>            
            <p>Silahkan submit write up dengan klik tombol dibawah : </p>
        @elseif ($kategori->id_ormawa == 1)
            <p>Silahkan submit karya tulis dan poster dengan klik tombol dibawah : </p>
            @elseif ($kategori->id_ormawa == 2)
                <p>Silahkan submit karya tulis dengan klik tombol di bawah ini : </p>
        @else
            <p>Silahkan submit karya tulis dengan klik tombol dibawah : </p>
        @endif
        @include('beautymail::templates.sunny.contentEnd')
        @include('beautymail::templates.sunny.button', [
        	'title' => 'Submit',
        	'link' => route('kompetisi.submit.index', ['token' => $kode])])

            @if ($kategori->id_ormawa == 2 || in_array($kategori->kategori, ['uiux', 'iot', 'game', 'gamedev', 'game-dev', 'animasi', 'data-mining']))
                @include('beautymail::templates.sunny.contentStart')
                <p> Link Grup WhatsApp :
                    <a href="https://bit.ly/GrupPesertaITEC2026">Grup WA Peserta ITeC 2026</a>
                </p>
                @include('beautymail::templates.sunny.contentEnd')
                
                @include('beautymail::templates.sunny.contentStart')
                <p>atau akses link submit berikut :
                    <a href="{{ route('kompetisi.submit.index', ['token' => $kode]) }}">{{ route('kompetisi.submit.index', ['token' => $kode]) }}</a>
                </p>
                @include('beautymail::templates.sunny.contentEnd')
            @else
                @include('beautymail::templates.sunny.contentStart')
                <p>atau akses link submit berikut :
                    <a href="{{ route('kompetisi.submit.index', ['token' => $kode]) }}">{{ route('kompetisi.submit.index', ['token' => $kode]) }}</a>
                </p>
                @include('beautymail::templates.sunny.contentEnd')
            @endif
    @endif




@stop
