@extends('admin.layouts.base')

{{--Page Title--}}
@section('title', 'Kirim Pengumuman Tidak Lolos')

{{--App Title--}}
@section('app-title', 'Kirim Pengumuman Tidak Lolos ' . $kategori->nama_kategori)
@section('app-description', '')

{{--Content--}}
@section('content')
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="title">Kirim Pengumuman Tidak Lolos - {{ $kategori->nama_kategori }}</h3>
                </div>

                <div class="tile-body">
                    <form action="{{ route('admin.final.gugur.store', ['kategori' => $kategori->kategori ]) }}" method="post">
                        @csrf
                        <p>Silahkan ketik dan pilih nama tim yang <b>tidak lolos</b> ke babak Final untuk dikirimi email pengumuman:</p>
                        <h4>Nama Tim</h4>

                        <select class="form-control" id="demoSelect" multiple="" name="tims[]">
                            <optgroup label="Nama Tim">
                                @foreach($tims as $tim)
                                    <option value="{{ $tim->id }}">{{ $tim->nama_tim }}</option>
                                @endforeach
                            </optgroup>
                        </select>

                        <div class="tile-footer">
                            <button class="btn btn-warning" type="submit" name="submit">
                                <i class="fa fa-envelope-o"></i> Kirim Pengumuman
                            </button>
                            <a href="{{ route('admin.final.index', ['kategori' => $kategori->kategori]) }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

{{--Custom Javascript--}}
@section('js')
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/select2.min.js') }}"></script>
    <script>
        $('#demoSelect').select2({
            placeholder: "Ketik dan pilih nama tim..."
        });
    </script>
@endsection
