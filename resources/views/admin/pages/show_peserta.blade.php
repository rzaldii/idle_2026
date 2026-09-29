@extends('admin.layouts.base')

{{--Page Title--}}
@section('title', 'Peserta')

{{--Custom CSS--}}
@section('css')
@endsection

{{--App Title--}}
@section('app-title', 'Identitas Peserta')
@section('app-description', '')

{{--Content--}}
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title">
                    {{ $mahasiswa->nama }} - {{ $mahasiswa->nim }}
                    <p style="font-size: 15px; font-weight: normal; margin-top: 8px;">
                        <i class="fa fa-envelope"></i> {{ $mahasiswa->email }} <br>
                        <i class="fa fa-phone"></i> {{ $mahasiswa->no_hp }}
                    </p>
                    <a class="btn btn-secondary" href="{{ route('admin.peserta.index') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <a class="btn btn-primary" href="{{ route('admin.peserta.edit', ['peserta' => $mahasiswa->nim]) }}"><i class="fa fa-edit"></i> Edit</a>
                </div>
                <div class="tile-body">
                    <h4>Daftar Tim yang Diikuti</h4>
                    <table class="table table-hover table-bordered" id="tim-table">
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama TIM</th>
                            <th>Kategori</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($mahasiswa->pesertas as $no => $peserta)
                            @if($peserta->tim)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td><a href="{{ route('admin.tim.show', ['tim' => $peserta->tim->id]) }}">{{ $peserta->tim->nama_tim }}</a></td>
                                <td>{{ $peserta->tim->kategori->nama_kategori ?? '-' }}</td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--Custom Javascript--}}
@section('js')
@endsection
