@extends('layouts.base')

@section('title', 'Submit')

@section('css')
<style media="screen">
  body{
    background-color: #F3F2F0;
  }
  .card{
    border-radius: 10px;
    padding: 25px 15%;
  }
</style>
@endsection

@section('content')
    <div class="container hero" style="margin-top: 1px;">
        <div class="row">
            <div class="col-md-12" style="height: auto;padding-top: 62px;">
                <div style="margin-bottom: 11px;">
                    <h1  style="color: rgb(0,0,0);margin-top: 71px;, sans-serif;"></h1>
                    <h1 class="text-center page_title">Submit Final</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /blue -->


    <!-- *****************************************************************************************************************
       BLOG CONTENT
       ***************************************************************************************************************** -->

       <div class="card" style="margin-top: 10px;">
           <div class="card-body">
               @foreach ($errors->all() as $error)
               <div class="alert alert-danger" role="alert">
                  <li style="color: red">{{ $error }}</li>
               </div>
               @endforeach
               @if ($tim->kategori->id_ormawa==1)
               <h2>Halo {{$tim->nama_tim}}, Selamat!</h2>
               <p>Tim anda telah melewati tahapan seleksi pada bidang lomba {{ $tim->kategori->nama_kategori }}. Pada tahap final anda diharuskan mengunggah <b>file .PDF</b> berisi <italic>file presentasi</italic></p>
               @elseif ($tim->kategori->id_ormawa==2)
               <h2>Halo {{$tim->nama_tim}}, Selamat!</h2>
               <p>Tim anda telah melewati tahapan seleksi pada bidang lomba {{ $tim->kategori->nama_kategori }}. Pada tahap final anda diharuskan mengunggah <b>file .PDF</b> berisi <italic>file Power Point (presentasi)</italic></p>
               @else
               <h2>Dear {{$tim->nama_tim}}, Selamat!</h2>
               <p>Tim anda telah melewati seluruh tahapan seleksi pada bidang lomba {{ $tim->kategori->nama_kategori }}. Pada tahap final anda diharuskan mengunggah <b>file .ZIP</b> berisi: <italic>proposal akhir</italic> dan <italic>file presentasi</italic></p>
               @endif
               <div class="row">
                   <div class="col-lg-12">

                       <form class="contact-form" role="form" action="{{ route('kompetisi.submit.store', ['token' => $tim->submissionid]) }}" method="POST"  enctype="multipart/form-data">

                           <div class="form-group">
                               <label for="" style="float: left;">Judul</label>
                               <input type="text" name="judul" class="form-control" placeholder="Judul" required>
                               <div class="validate"></div>
                           </div>

                           @csrf
                           @if ($tim->kategori->id_ormawa==1)
                           <div class="form-group">
                               <label for="" style="float: left;">Silahkan masukan file (PDF)</label>
                               <input type="file" name="file" class="form-control" id="contact-name" placeholder="File" required>
                           </div>
                           @elseif ($tim->kategori->id_ormawa==2)
                           <div class="form-group">
                               <label for="" style="float: left;">Silahkan masukan file (PDF)</label>
                               <input type="file" name="file" class="form-control" id="contact-name" placeholder="File" required>
                           </div>
                           @else
                            <div class="form-group">
                               <label for="" style="float: left;">Silahkan masukan file (ZIP)</label>
                               <input type="file" name="file" class="form-control" id="contact-name" placeholder="File" required>
                           </div>
                           @endif
                           
                           <small style="color:red">Pastikan ukuran file tidak lebih dari 10 Mb.</small>

                           <div class="form-send">
                               <button type="submit" class="btn btn-success shadow">Submit</button>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
        </div>
@endsection
