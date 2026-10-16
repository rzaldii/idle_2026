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

               @if(session('success'))
               <div class="alert alert-success" role="alert">
                  {{ session('success') }}
               </div>
               @endif

               @if(session('error'))
               <div class="alert alert-danger" role="alert">
                  {{ session('error') }}
               </div>
               @endif

               @if(isset($submission) && $submission)
               <div class="alert alert-info" role="alert" style="text-align: left; border-radius: 8px;">
                   <i class="fa fa-info-circle"></i> <b>Status Pengumpulan:</b> Tim Anda sudah mengumpulkan berkas pada <b>{{ date('d F Y, H:i', strtotime($submission->created_at)) }} WIB</b> (Judul: <i>{{ $submission->judul }}</i>).<br>
                   <small class="text-muted">Anda dapat mengunggah kembali formulir di bawah ini jika terdapat revisi/perbaikan sebelum batas waktu.</small>
               </div>
               @endif

               @if ($tim->kategori->id_ormawa==1)
               <h2>Halo {{$tim->nama_tim}}, Selamat!</h2>
               <p>Tim anda telah melewati tahapan seleksi pada bidang lomba {{ $tim->kategori->nama_kategori }}. Pada tahap final anda diharuskan mengunggah <b>file .PDF</b> berisi <italic>file presentasi</italic></p>
               @elseif ($tim->kategori->id_ormawa==2)
               <h2>Halo {{$tim->nama_tim}}, Selamat!</h2>
               <p>Tim Anda telah melewati tahapan seleksi pada cabang lomba <b>{{ $tim->kategori->nama_kategori }}</b>. Pada tahap final Anda diharuskan mengunggah <b>2 file (PDF)</b>: <b>Proposal Revisi</b> dan <b>File PPT / Presentasi</b>.</p>
               @else
               <h2>Dear {{$tim->nama_tim}}, Selamat!</h2>
               <p>Tim anda telah melewati seluruh tahapan seleksi pada bidang lomba {{ $tim->kategori->nama_kategori }}. Pada tahap final anda diharuskan mengunggah <b>file .ZIP</b> berisi: <italic>proposal akhir</italic> dan <italic>file presentasi</italic></p>
               @endif
               <div class="row">
                   <div class="col-lg-12">

                       <form class="contact-form" role="form" action="{{ route('kompetisi.submit.store', ['token' => $tim->submissionid]) }}" method="POST"  enctype="multipart/form-data">

                           <div class="form-group" style="text-align: left;">
                               <label for="judul" style="font-weight: 600;">Judul Karya / Proyek <span style="color: red;">*</span></label>
                               <input type="text" name="judul" class="form-control" id="judul" value="{{ old('judul', $submission->judul ?? '') }}" placeholder="Masukkan judul karya" required>
                               <div class="validate"></div>
                           </div>

                           @csrf
                           @if ($tim->kategori->id_ormawa==1)
                           <div class="form-group" style="text-align: left;">
                               <label for="contact-name" style="font-weight: 600;">Silahkan masukan file (PDF) <span style="color: red;">*</span></label>
                               <input type="file" name="file" class="form-control" id="contact-name" placeholder="File" required>
                           </div>
                           @elseif ($tim->kategori->id_ormawa==2)
                           <div class="form-group" style="text-align: left;">
                               <label for="file_proposal" style="font-weight: 600;">1. File Proposal Revisi (PDF) <span style="color: red;">*</span></label>
                               <input type="file" name="file_proposal" class="form-control" id="file_proposal" accept=".pdf,application/pdf" required>
                               <small class="text-muted">Format file harus berupa PDF, maksimal 10 MB.</small>
                           </div>
                           <div class="form-group" style="text-align: left; margin-top: 15px;">
                               <label for="file_ppt" style="font-weight: 600;">2. File Power Point / Presentasi (PDF) <span style="color: red;">*</span></label>
                               <input type="file" name="file_ppt" class="form-control" id="file_ppt" accept=".pdf,application/pdf" required>
                               <small class="text-muted">Format file harus berupa PDF (ekspor/save as PDF), maksimal 10 MB.</small>
                           </div>
                           @else
                            <div class="form-group" style="text-align: left;">
                               <label for="contact-name" style="font-weight: 600;">Silahkan masukan file (ZIP) <span style="color: red;">*</span></label>
                               <input type="file" name="file" class="form-control" id="contact-name" placeholder="File" required>
                           </div>
                           @endif
                           
                           <div style="text-align: left; margin-top: 10px;">
                               <small style="color:red">* Pastikan masing-masing ukuran file tidak lebih dari 10 MB.</small>
                           </div>

                           <div class="form-send" style="margin-top: 20px;">
                               <button type="submit" class="btn btn-success shadow"><i class="fa fa-upload"></i> Submit Berkas Final</button>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
        </div>
@endsection
