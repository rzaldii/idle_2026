@extends('layouts.base')

@section('title', 'IDLe ' . $kategori->nama_kategori)

@section('css')
<style media="screen">
  label{
    color: white;
    font-weight: bold;
  }
  body{
    background-color: #F3F2F0;
  }
  .card{
    border-radius: 10px;
    padding: 25px 10%;
    min-height: 500px;
  }
</style>
@endsection

@section('content')
    <div class="container hero" style="margin-top: 1px;">
        <div class="row">
            <div class="col-md-12" style="height: auto;padding-top: 62px;">
                <div style="margin-bottom: 11px;">
                    <h1  style="color: rgb(0,0,0);margin-top: 71px;, sans-serif;"></h1>
                    <h1 class="text-center page_title">Kompetisi {{ $kategori->nama_kategori }}</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- *****************************************************************************************************************
       DESCRIPTION
       ***************************************************************************************************************** -->
   <div class="card">
       <div class="card-body">
           <div class="row">
               <div class="col-auto col-md-6 align-self-center">
                  <img class="img-fluid float-right" data-bs-hover-animate="pulse" src="{{asset('assets/img/kategori/'.$kategori->kategori.'.jpg')}}">
               </div>
               <div class="col-auto col-md-6">
                   <p class="text-justify">
                     Capture the Flag adalah salah satu jenis dari kompetisi hacking yang dimana mengharuskan seorang / tim untuk mengambil sebuah file / string yang sudah disembunyikan sistem yang dimana disebut dengan istilah “Flag”. Berbeda dari lomba lainnya seperti competitive programming yang dimana alatnya disediakan oleh panitia, Peserta CTF biasanya akan diminta untuk membawa peralatan (laptop/alat lainnya) sendiri dan diperbolehkan mempersiapkan script-script / programnya yang sudah ada dari waktu sebelum pertandingan.
                    <br>Untuk tipe Capture the Flag sendiri ada berbagai macam, ada yang tipenya jeopardy, yang dimana jeopardy ini menggunakan server untuk menyimpan soal, yang dimana soalnya bisa berbentuk web exploitation, reverse engineering, binary exploitation, forensic, cryptography, steganography, dan lain lain dengan tujuan yang tetap sama yaitu mencari string/flag yang disembunyikan oleh server.
                    <br>Untuk tipe lainnya ada Attack and Defense (War) yang dimana masing-masing peserta / tim akan diberikan virtual machine / image server. Yang nantinya peserta akan diminta menghardening sistem tersebut selamat periode waktu tertentu (fase bertahan), lalu nantinya akan masuk ke fase selanjutnya yaitu fase menyerang yang dimana para competitor akan saling meyerang satu sistem dengan yang lainnya. Yang tujuan mendapatkan pointnya bisa berbeda, bisa dengan mendapatkan flag juga. Atau bisa dihitung dari waktu downtime yang dialami oleh competitor lainnya. (jadi pemenang dihitung dari waktu uptime server terbanyak).
                     </p>
                     <!--<a class="btn btn-success shadow" href="{{ asset('assets/rulebook/'.$kategori->kategori.'.pdf') }}">Rule Book</a>-->
                     <a class="btn btn-success shadow" href="https://drive.google.com/file/d/1BWUEosFhzYQ_8LqAgxxHMhB2TxYjsef2/view?usp=sharing">Rule Book</a>
                     <a class="btn btn-success shadow" href="{{ route('kompetisi.peserta', ['kategori' => $kategori->kategori]) }}">Daftar Peserta</a>
               </div>
           </div>
       </div>
        </div>
       <div data-bs-parallax-bg="true" class="register-img">
            <form method="post" class="register-form" action="{{ route('kompetisi.store', ['kategori' => $kategori->id]) }}" method="POST">
              <!-- <h1 class="text-center" style="font-family: Nunito, sans-serif;font-weight: bold;color: rgb(255,255,255);">Pendaftaran kompetisi {{ $kategori->nama_kategori }} belum dibuka! <br>
              Tunggu kami pada tanggal 15 April 2021</h1> --> 
                @csrf            
                <input type="hidden" value="{{ $kategori->id }}" name="kategori">
                <h2 class="text-center" style="font-family: Nunito, sans-serif;font-weight: bold;color: rgb(255,255,255);">Pendaftaran</h2>
                <div class="form-group">
                  <label>Nama Tim</label>
                  <input class="form-control" type="text" name="nama_tim" value="{{ old('nama_tim') }}" placeholder="Nama Tim"></div>
                <div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Nama Ketua</label>
                              <input class="form-control" type="text" name="nama[]" value="{{ old('nama[0]') }}" required placeholder="Nama Ketua"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>NIM Ketua</label>
                              <input class="form-control" type="text" name="nim[]" pattern="[0-9]{12,13}" inputmode="numeric" value="{{ old('nim[0]') }}" required placeholder="NIM Ketua"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Email Ketua</label>
                              <input class="form-control" type="email" name="email[]" value="{{ old('email[0]') }}" required placeholder="Email Ketua"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>No. Whatsapp Ketua</label>
                              <input class="form-control" type="text" name="no_hp[]" value="{{ old('no_hp[0]') }}" required placeholder="No. Whatsapp Ketua"></div>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 30px;">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Nama Anggota 1</label>
                              <input class="form-control" type="text" name="nama[]" value="{{ old('nama[1]') }}"  placeholder="Nama Anggota 1"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>NIM Anggota 1</label>
                              <input class="form-control" type="text" name="nim[]" pattern="[0-9]{12,13}" inputmode="numeric" value="{{ old('nim[1]') }}"  placeholder="NIM Anggota 1"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Email Anggota 1</label>
                              <input class="form-control" type="email" name="email[]" value="{{ old('email[1]') }}"  placeholder="Email Anggota 1"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>No. Whatsapp Anggota 1</label>
                              <input class="form-control" type="text" name="no_hp[]" value="{{ old('no_hp[1]') }}" placeholder="No. Whatsapp Anggota 1"></div>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 30px;">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Nama Anggota 2</label>
                              <input class="form-control" type="text" name="nama[]" value="{{ old('nama[2]') }}" placeholder="Nama Anggota 2"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>NIM Anggota 2</label>
                              <input class="form-control" type="text" name="nim[]" pattern="[0-9]{12,13}" inputmode="numeric" value="{{ old('nim[2]') }}" placeholder="NIM Anggota 2"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Email Anggota 2</label>
                              <input class="form-control" type="email" name="email[]" value="{{ old('email[2]') }}" placeholder="Email Anggota 2"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>No. Whatsapp Anggota 2</label>
                              <input class="form-control" type="text" name="no_hp[]" value="{{ old('no_hp[2]') }}" placeholder="No. Whatsapp Anggota 2"></div>
                        </div>
                    </div>
                </div>
                <div class="text-center" ><button class="btn btn-success" id="reg-submit" type="submit">Daftar</button></div>
				
            </form>
        </div>
@endsection
