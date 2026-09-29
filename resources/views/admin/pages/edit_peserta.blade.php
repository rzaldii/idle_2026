@extends('admin.layouts.base')

{{--Page Title--}}
@section('title', 'Peserta')

{{--Custom CSS--}}
@section('css')
@endsection

{{--App Title--}}
@section('app-title', 'Edit Peserta')
@section('app-description', '')

{{--Content--}}
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Edit Peserta</h3>
                <form method="post" action="{{ route('admin.peserta.update', ['peserta' => $mahasiswa->nim]) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input class="form-control" id="nim" type="text" value="{{ $mahasiswa->nim }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input class="form-control" id="nama" type="text" value="{{ $mahasiswa->nama }}" name="nama" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" type="email" value="{{ $mahasiswa->email }}" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input class="form-control" id="no_hp" type="text" value="{{ $mahasiswa->no_hp }}" name="no_hp" required>
                    </div>

                    <a href="{{ route('admin.peserta.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

{{--Custom Javascript--}}
@section('js')
@endsection
