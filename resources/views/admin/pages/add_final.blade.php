@extends('admin.layouts.base')

{{--Page Title--}}

@section('title', 'Peserta Final')

{{--Custom CSS--}}

@section('css')

@endsection

{{--App Title--}}

@section('app-title', 'Tambah Peserta Final ' . $kategori->kategori)
@section('app-description', '')

{{--Content--}}

@section('content')
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="title">Tambah Peserta {{ $kategori->nama_kategori }} Tahap Final</h3>
                </div>

                <div class="tile-body">
                    <form action="{{ route('admin.final.store', ['kategori' => $kategori->kategori ]) }}" method="post">
                        @csrf
                        <p>Silahkan pilih nama tim yang lolos ke babak Final</p>
                        <h4>Nama Tim</h4>

                        <select class="form-control" id="demoSelect" multiple="" name="tims[]">
                            <optgroup label="Nama Tim">
                                @foreach($tims as $tim)
                                    <option value="{{ $tim->id }}">{{ $tim->nama_tim }}</option>
                                @endforeach
                            </optgroup>
                        </select>

                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
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
        $('#demoSelect').select2();
    </script>
@endsection