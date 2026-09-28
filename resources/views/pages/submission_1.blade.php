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
                    <h1 class="text-center page_title">Submit Tahap 1</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- /blue -->


    <!-- *****************************************************************************************************************
       BLOG CONTENT
       ***************************************************************************************************************** -->
       @if ($kategori->kategori == 'data-mining' )
        <div class="card" style="margin-top: 10px;">
            <div class="card-body">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <li style="color: red">{{ $error }}</li>
                    </div>
                @endforeach
                <h2>Halo, {{ $tim->nama_tim }}</h2>
                <p>Pada tahap pertama {{ $tim->kategori->nama_kategori }} adalah pengumpulan karya tulis dalam format
                    <b>.PDF</b></p>
                <div class="row">
                    <div class="col-lg-12">
                        <form class="contact-form" role="form"
                            action="{{ route('kompetisi.submit.store', ['token' => $tim->submissionid]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="" style="float: left;">Judul</label>
                                <input type="text" name="judul" class="form-control" placeholder="Judul" required>
                                <div class="validate"></div>
                            </div>

                            <div class="form-group">
                                <label for="" style="float: left;">Silahkan masukan file (PDF)</label>
                                <input type="file" name="file" class="form-control" id="contact-name"
                                    placeholder="File" required>
                            </div>

                            <small style="color:red">Pastikan ukuran file tidak lebih dari 10 Mb.</small>

                            <div class="form-send">
                                <button type="submit" class="btn btn-success shadow">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       @elseif ($kategori->kategori == 'bisnis-tik' )
        <div class="card" style="margin-top: 10px;">
            <div class="card-body">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <li style="color: red">{{ $error }}</li>
                    </div>
                @endforeach
                <h2>Halo, {{ $tim->nama_tim }}</h2>
                <p>Pada tahap pertama {{ $tim->kategori->nama_kategori }} adalah pengumpulan pitch deck dan poster dalam format
                    <b>.ZIP/RAR</b></p>
                <div class="row">
                    <div class="col-lg-12">
                        <form class="contact-form" role="form"
                            action="{{ route('kompetisi.submit.store', ['token' => $tim->submissionid]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="" style="float: left;">Judul</label>
                                <input type="text" name="judul" class="form-control" placeholder="Judul" required>
                                <div class="validate"></div>
                            </div>

                            <div class="form-group">
                                <label for="" style="float: left;">Silahkan masukan file (ZIP/RAR)</label>
                                <input type="file" name="file" class="form-control" id="contact-name"
                                    placeholder="File" required>
                            </div>

                            <small style="color:red">Pastikan ukuran file tidak lebih dari 10 Mb.</small>

                            <div class="form-send">
                                <button type="submit" class="btn btn-success shadow">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @elseif ($tim->kategori->id_ormawa==1)
        <div class="card" style="margin-top: 10px;">
            <div class="card-body">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <li style="color: red">{{ $error }}</li>
                    </div>
                @endforeach
                <h2>Halo, {{ $tim->nama_tim }}</h2>
                <p>Pada tahap pertama {{ $tim->kategori->nama_kategori }} adalah pengumpulan proposal dan poster dalam format
                    <b>.ZIP/RAR</b></p>
                <div class="row">
                    <div class="col-lg-12">
                        <form class="contact-form" role="form"
                            action="{{ route('kompetisi.submit.store', ['token' => $tim->submissionid]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="" style="float: left;">Judul</label>
                                <input type="text" name="judul" class="form-control" placeholder="Judul" required>
                                <div class="validate"></div>
                            </div>

                            <div class="form-group">
                                <label for="" style="float: left;">Silahkan masukan file (ZIP/RAR)</label>
                                <input type="file" name="file" class="form-control" id="contact-name"
                                    placeholder="File" required>
                            </div>

                            <small style="color:red">Pastikan ukuran file tidak lebih dari 10 Mb.</small>

                            <div class="form-send">
                                <button type="submit" class="btn btn-success shadow">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($kategori->kategori == 'uiux' )
        <div class="card" style="margin-top: 10px;">
            <div class="card-body">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <li style="color: red">{{ $error }}</li>
                    </div>
                @endforeach
                <h2>Halo, {{ $tim->nama_tim }}</h2>
                <p>Pada tahap pertama {{ $tim->kategori->nama_kategori }} adalah pengumpulan karya tulis dalam format
                    <b>.PDF</b></p>
                <div class="row">
                    <div class="col-lg-12">
                        <form class="contact-form" role="form"
                            action="{{ route('kompetisi.submit.store', ['token' => $tim->submissionid]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="" style="float: left;">Judul</label>
                                <input type="text" name="judul" class="form-control" placeholder="Judul" required>
                                <div class="validate"></div>
                            </div>

                            <div class="form-group">
                                <label for="" style="float: left;">Silahkan masukan file (PDF)</label>
                                <input type="file" name="file" class="form-control" id="contact-name"
                                    placeholder="File" required>
                            </div>

                            <small style="color:red">Pastikan ukuran file tidak lebih dari 10 Mb.</small>

                            <div class="form-send">
                                <button type="submit" class="btn btn-success shadow">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="card" style="margin-top: 10px;">
        <div class="card-body">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <li style="color: red">{{ $error }}</li>
                </div>
            @endforeach
            <h2>Halo, {{ $tim->nama_tim }}</h2>
            <p>Pada tahap pertama {{ $tim->kategori->nama_kategori }} adalah pengumpulan proposal dalam format <b>.PDF</b>
            </p>
            <div class="row">
                <div class="col-lg-12">
                    <form class="contact-form" role="form"
                        action="{{ route('kompetisi.submit.store', ['token' => $tim->submissionid]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="" style="float: left;">Judul</label>
                            <input type="text" name="judul" class="form-control" placeholder="Judul" required>
                            <div class="validate"></div>
                        </div>

                        <div class="form-group">
                            <label for="" style="float: left;">Silahkan masukan file (PDF)</label>
                            <input type="file" name="file" class="form-control" id="contact-name" placeholder="File"
                                required>
                        </div>

                        <small style="color:red">Pastikan ukuran file tidak lebih dari 10 Mb.</small>

                        <div class="form-send">
                            <button type="submit" class="btn btn-success shadow">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endif
@endsection
